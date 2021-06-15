<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'image' => 'Image',
            'company_id' => 'Company Id',
        ],
    ],

    'services' => [
        'name' => 'Services',
        'index_title' => 'Services List',
        'create_title' => 'Create Service',
        'edit_title' => 'Edit Service',
        'show_title' => 'Show Service',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'companies' => [
        'name' => 'Companies',
        'index_title' => 'Companies List',
        'create_title' => 'Create Company',
        'edit_title' => 'Edit Company',
        'show_title' => 'Show Company',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'contact_numeber' => 'Contact Numeber',
            'service_id' => 'Service Id',
        ],
    ],

    'buses' => [
        'name' => 'Buses',
        'index_title' => 'Buses List',
        'create_title' => 'Create Bus',
        'edit_title' => 'Edit Bus',
        'show_title' => 'Show Bus',
        'inputs' => [
            'name' => 'Name',
            'image' => 'Image',
            'bus_number' => 'Bus Number',
            'company_id' => 'Company Id',
            'seat_class_id' => 'Seat Class Id',
            'bus_category_id' => 'Bus Category Id',
        ],
    ],

    'bus_categories' => [
        'name' => 'Bus Categories',
        'index_title' => 'BusCategories List',
        'create_title' => 'Create BusCategory',
        'edit_title' => 'Edit BusCategory',
        'show_title' => 'Show BusCategory',
        'inputs' => [
            'name' => 'Name',
            'total seat' => 'Total Seat',
            'seatnumbers' => 'Seatnumbers',
        ],
    ],

    'bus_routes' => [
        'name' => 'Bus Routes',
        'index_title' => 'BusRoutes List',
        'create_title' => 'Create BusRoute',
        'edit_title' => 'Edit BusRoute',
        'show_title' => 'Show BusRoute',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'bus_schedules' => [
        'name' => 'Bus Schedules',
        'index_title' => 'BusSchedules List',
        'create_title' => 'Create BusSchedule',
        'edit_title' => 'Edit BusSchedule',
        'show_title' => 'Show BusSchedule',
        'inputs' => [
            'date' => 'Date',
            'bus_id' => 'Bus Id',
            'bus_route_id' => 'Bus Route Id',
        ],
    ],

    'seat_classes' => [
        'name' => 'Seat Classes',
        'index_title' => 'SeatClasses List',
        'create_title' => 'Create SeatClass',
        'edit_title' => 'Edit SeatClass',
        'show_title' => 'Show SeatClass',
        'inputs' => [
            'name' => 'Name',
            'unit_seat_price' => 'Unit Seat Price',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
