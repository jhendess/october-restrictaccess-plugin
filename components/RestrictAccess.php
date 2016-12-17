<?php

namespace Jhendess\RestrictAccess\Components;

use Cms\Classes\ComponentBase;
use KurtJensen\Passage\Models\Key;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class RestrictAccess extends ComponentBase {

    private static $PERMISSION_PROPERTY = "permission";

    /**
     * Returns information about this component, including name and description.
     */
    public function componentDetails() {
        return [
            "name" => "Restrict access",
            "description" => "Restrict access to this page based on a required permission."
        ];
    }

    /**
     * Defines the properties used by this class.
     * This method should be used as an override in the extended class.
     */
    public function defineProperties() {
        return [
            RestrictAccess::$PERMISSION_PROPERTY => [
                'title' => 'Required access right',
                'description' => 'The required access right to view this page.',
                'type' => 'dropdown'
            ]
        ];
    }

    public function getPermissionOptions() {
        $values = [];
        $allKeys = Key::all();
        foreach ($allKeys AS $key) {
            $values[$key->name] = $key->description;
        }
        return $values;
    }

    /**
     * Executed when this component is bound to a page or layout, part of
     * the page life cycle.
     */
    public function onRun() {
        $requiredPermission = $this->property(RestrictAccess::$PERMISSION_PROPERTY);
        if ($requiredPermission) {
            $permissionGranted = \KurtJensen\Passage\Plugin::hasKeyName($requiredPermission);
            if (!$permissionGranted) {
                throw new AccessDeniedHttpException();
            }
        }
    }
}