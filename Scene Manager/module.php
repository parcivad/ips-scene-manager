<?php

class SceneManager extends IPSModule {

    /*
    * Internal function of SDK
    */
    public function Create()
    {
        // Overwrite ips function
        parent::Create();

        // interface variable
        $this->RegisterPropertyBoolean("active", true );
        $this->RegisterPropertyString("scenes", "[]");
    }
    /*
     * Internal function of SDK
     */
    public function ApplyChanges() {
        // Overwrite ips function
        parent::ApplyChanges();

        // save list
        $arr = $this->ReadPropertyString("scenes");
        IPS_LogMessage("SceneManager", $arr );
    }

    //-----------------------------------------------------< Setting Form.json >------------------------------
    public function GetConfigurationForm()
    {
        // return current form
        $Form = json_encode([
            'elements' => $this->FormElements(),
            'actions'  => $this->FormActions(),
            'status'   => $this->FormStatus(),
        ]);
        $this->SendDebug('FORM', $Form, 0);
        $this->SendDebug('FORM', json_last_error_msg(), 0);

        return $Form;
    }

    /**
     * @return array[] Form Actions
     */
    protected function FormActions() {
        return[

        ];
    }

    /**
     * @return array[] Form Elements
     */
    protected function FormElements() {

        return[
            [
                "type" => "Image",
                "image" => "data:image/png;base64,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"
            ],
            [
                "type" => "RowLayout",
                "items" => [
                    [
                        "type" => "CheckBox",
                        "caption" => "Scene manager active",
                        "name" => "active"
                    ],
                    [
                        "type" => "Label",
                        "caption" => "TEXT"
                    ]
                ]
            ],
            [
                "type" => "Tree",
                "name" => "scenes",
                "caption" => "Controlled scenes of this manager",
                "add" => true,
                "delete" => true,
                "changeOrder" => true,

                "columns" => [
                    [
                        "caption" => "React to",
                        "name" => "reactInstance",
                        "width" => "140px",
                        "add" => 0,
                        "edit" => [
                            "type" => "SelectVariable"
                        ],
                    ],
                    [
                        "caption" => "Scene name",
                        "name" => "sceneName",
                        "width" => "auto",
                        "add" => "",
                        "edit" => [
                            "type" => "ValidationTextBox"
                        ],
                    ],
                ],

                "values" => $this->ReadPropertyString("scenes")
            ]
        ];
    }

    /**
     * @return array[] Form Status
     */
    protected function FormStatus() {
        return [
            [
                'code'    => 101,
                'icon'    => 'inactive',
                'caption' => 'Creating instance',
            ],
            [
                'code'    => 102,
                'icon'    => 'active',
                'caption' => 'Instance created',
            ],
            [
                'code'    => 104,
                'icon'    => 'inactive',
                'caption' => 'instance closed',
            ]
        ];
    }

}
?>