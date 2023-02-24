<?php

namespace ErikGaal\BladeStreamlineIcons;

class BladeStreamlineIcons
{
    private array $familyAliases = [];

    public function __construct(
        private readonly StreamlineApi $api,
    ) {}

    public function download(IconFamily $family, string $icon): ?string
    {
        $icon = $this->api->search($family, $icon)->firstWhere('slug', $icon);

        if (! $icon) {
            return null;
        }

        return $this->api->download($icon['hash']);
    }

    public function family(string $name): IconFamily
    {
        return new IconFamily($this->familyAliases[$name] ?? $name);
    }

    public function addFamilyAlias(string $alias, string $family): void
    {
        $this->familyAliases[$alias] = $family;
    }
}
