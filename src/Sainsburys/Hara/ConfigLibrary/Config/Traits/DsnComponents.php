<?php
namespace Sainsburys\Hara\ConfigLibrary\Config\Traits;

trait DsnComponents
{
    public function dsnComponentsForService(string $serviceNickname, string $alternative = null): array
    {
        $dsnString  = $this->dsnForService($serviceNickname, $alternative);
        $components = [];
        $sections   = explode(':', $dsnString, 2);

        $components['adapter'] = $sections[0];

        if ('sqlite' == $components['adapter']) {
            $components['path'] = $sections[1];
        } else {
            foreach (explode(';', $sections[1]) as $assignment) {
                $sides = explode('=', $assignment);
                $components[$sides[0]] = $sides[1];
            }
        }

        return $components;
    }
}
