const DocMenuConfig = [
    {
        pages: [
            {
                heading: "dashboard",
                route: "/dashboard",
                svgIcon: "media/icons/duotune/art/art002.svg",
                fontIcon: "bi-app-indicator",
                permission: "view-dashboard"
            },
        ],
    },
    {
        heading: "ENTITIES",
        route: "/crafted",
        pages: [
            {
                heading: "applicants",
                route: "/applicants",
                svgIcon: "media/icons/duotune/communication/com006.svg",
                fontIcon: "bi-person",
                permission: "view-applicants"
            },
            {
                heading: "demands",
                route: "/demands",
                svgIcon: "media/icons/duotune/general/gen022.svg",
                fontIcon: "bi-archive",
                permission: "view-demands"
            },
            {
                sectionTitle: "user management",
                route: 'user-management',
                svgIcon: "media/icons/duotune/general/gen025.svg",
                fontIcon: "bi-archive",
                permission: "view-user-management",

                sub: [
                    {
                        heading: "users",
                        route: "/user-management/users",
                        permission: "view-users",
                    },
                    {
                        heading: "roles",
                        route: "/user-management/roles",
                        permission: "view-permissions",
                    },
                    {
                        heading: "permission",
                        route: "/user-management/permissions",
                        permission: "view-permissions",
                    },
                ]

            },
            {
                heading: "site variables",
                route: "/site-variables",
                svgIcon: "media/icons/duotune/general/gen022.svg",
                fontIcon: "bi-archive",
                permission: "view-site-variables"
            },

        ],
    },
];

export default DocMenuConfig;
