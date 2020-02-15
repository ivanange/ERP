<?php

namespace App\Faker;

use Faker\Provider\Base;

class CustomProvider extends Base
{
    public $ofPrefixes = ['Manager', 'Director', 'Inspector'];
    public $ofMiddle = ['of', 'in charge of'];
    public $ofSuffixes = ['Sales', 'Marketting', 'External Affairs', 'Research and Developement', 'Security',  'Production', 'Juridic Affairs', 'Social Affairs', "Technical Affairs and Activities", "Human Resources (HR)"];
    public $supplementaryPrefix = ['Chief', 'Vice'];
    public $prefixes = ['Technical', 'Commercial', 'Security', 'Marketting'];
    public $suffixes = ['Assitant', 'Officer', 'Advisor', 'Administrator'];
    public $full = ['Chief Executive Officer (CEO)', 'Chief Technical Officer (CTO)', 'Secetary General', 'Assitant Secetary General', 'Founder', 'Lawyer', 'Cashier', 'Store keeper'];
    public $flows = [
        "out" => [
            "Taxes" => [
                "list" => [
                    [
                        "name" => "CRTV",
                        "frequency" => "+ 1 months"
                    ],
                    [
                        "name" => "Green House",
                        "frequency" => "+ 1 months"
                    ],
                    [
                        "name" => "Employment",
                        "frequency" => "+ 1 months"
                    ],
                    [
                        "name" => "Lodgment",
                        "frequency" => "+ 1 years"
                    ],
                    [
                        "name" => "CNPS Affiliation",
                        "frequency" => "+ 1 months"
                    ],
                ],

                "suffix" => "tax"
            ],

            "Working Materials and Services" => [
                "list" => [
                    [
                        "name" => "Writing materials",
                        "frequency" => "+ 1 months"
                    ],
                    [
                        "name" => "Hot Drinks and chewables",
                        "frequency" => "+ 1 months"
                    ],
                    [
                        "name" => "Operating Systems and Softwares Licences",
                        "frequency" => "+ 1 years"
                    ],
                ],

                "suffix" => ""
            ],

            "Bills" => [
                "list" => [
                    [
                        "name" => "Water",
                        "frequency" => "+ 1 months"
                    ],
                    [
                        "name" => "Electricity",
                        "frequency" => "+ 1 months"
                    ],
                    [
                        "name" => "Hosting",
                        "frequency" => "+ 1 years"
                    ],
                    [
                        "name" => "Internet Connection",
                        "frequency" => "+ 1 years"
                    ],
                ],
                "suffix" => "bill"
            ],
            "Social Investment and Donations" => [
                "list" => [
                    [
                        "name" => "St. Mary Orphanage condtrunction funding",
                        "frequency" => null
                    ],
                    [
                        "name" => "Contribution to renewal of Trafalgars street ",
                        "frequency" => null
                    ],
                    [
                        "name" => "Enterprise 20th Anniversary",
                        "frequency" => null
                    ],
                    [
                        "name" => "Scholarships contribution",
                        "frequency" => "+ 1 years"
                    ],
                    [
                        "name" => "Research and Development Contest",
                        "frequency" => "+ 1 years"
                    ],
                ],
                "suffix" => ""

            ],

            "Third Party Services" => [
                "list" => [
                    [
                        "name" => "Cleaning and Building Maintenance",
                        "frequency" => "+ 1 months"
                    ],
                    [
                        "name" => "Security and Protection",
                        "frequency" => "+ 1 months"
                    ],
                    [
                        "name" => "Technical Assistance and Training",
                        "frequency" => "+ 1 years"
                    ],
                ],

                "suffix" => "service"

            ]
        ],

        "in" => [
            "Donnations" => [
                "list" => [
                    [
                        "name" => "SNH Funding program",
                        "frequency" => "+ 1 years"
                    ],
                    [
                        "name" => "SME Funding program",
                        "frequency" => null
                    ],
                    [
                        "name" => "Government Investment",
                        "frequency" => null
                    ],

                ],
                "suffix" => "donnation"
            ],
            "Others" => [
                "list" => [
                    [
                        "name" => "CEMAC Innovation Contest Award",
                        "frequency" => null
                    ],
                    [
                        "name" => "Worlds Productivity Contest Award",
                        "frequency" => null
                    ],
                    [
                        "name" => "Research and Development Fund Raising",
                        "frequency" => null
                    ],

                ],
                "suffix" => ""
            ]
        ]

    ];

    // ,
    //  service,  service,  service,

    public function enterpriseJobTitle()
    {
        $function = $this->generator->randomElement(['ofTitle', 'simpleTitle', 'fullTitle']);
        return $this->$function();
    }

    public function ofTitle()
    {
        return $this->generator
            ->optional(0.2, "")
            ->randomElement($this->supplementaryPrefix) . " " .
            $this->generator->randomElement($this->ofPrefixes) . " " .
            $this->generator->randomElement($this->ofMiddle) . " " .
            $this->generator->randomElement($this->ofSuffixes);
    }

    public function fullTitle()
    {
        return $this->generator->randomElement($this->full);
    }

    public function simpleTitle()
    {
        return $this->generator
            ->optional(0.8, "")
            ->randomElement($this->supplementaryPrefix) . " " .
            $this->generator->randomElement($this->prefixes) . " " .
            $this->generator->randomElement($this->suffixes);
    }

    public function enterpriseDepartmentName()
    {
        return "Department of " . $this->generator->randomElement($this->ofSuffixes);
    }

    public function enterpriseFlow($type = null, $fixed = null, $category = null)
    {
        $type = $type ?? $this->generator->randomElement(["in", 'out']);
        $category = $category ??  $this->generator->randomElement(
            array_keys($this->flows[$type])
        );
        $flow = $this->generator->valid(
            function ($f) use ($fixed) {
                return $fixed ? $f["frequency"] === null : true;
            }
        )->randomElement($this->flows[$type][$category]["list"]);
        $flow["name"] .= " " . $this->flows[$type][$category]["suffix"];
        return $flow;
    }

    public function enterpriseFlowCategoryName($type = null)
    {
        $type = $type ?? $this->generator->randomElement(["in", 'out']);
        return $this->generator->randomElement(array_keys($this->flows[$type]));
    }

    public function flows()
    {
        return $this->flows;
    }
}
