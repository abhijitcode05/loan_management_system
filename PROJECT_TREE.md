# Project Tree (snapshot)

Generated: 2026-01-04
Branch: `ui-improvements`

.
├── artisan
├── composer.json
├── package.json
├── README.md
├── phpunit.xml
├── vite.config.js
├── tailwind.config.js
├── .gitignore
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── AuthenticatedSessionController.php
│   │   │   │   ├── RegisteredUserController.php
│   │   │   │   └── ...
│   │   │   ├── ProfileController.php
│   │   │   ├── LoanController.php
│   │   │   └── ...
│   │   ├── Middleware/
│   │   │   └── RoleMiddleware.php
│   │   └── Requests/
│   │       └── ProfileUpdateRequest.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Customer.php
│   │   ├── Loan.php
│   │   └── Repayment.php
│   └── View/
│       └── Components/
│           ├── AppLayout.php
│           └── GuestLayout.php
├── bootstrap/
├── config/
│   ├── app.php
│   ├── auth.php
│   └── database.php
├── database/
│   ├── migrations/
│   │   ├── 2025_12_31_090341_create_customers_table.php
│   │   ├── 2026_01_02_135222_create_loans_table.php
│   │   └── 2026_01_02_144758_create_repayments_table.php
│   ├── factories/
│   │   └── CustomerFactory.php
│   └── seeders/
│       └── AdminSeeder.php
├── public/
│   ├── index.php
│   └── build/ (generated assets)
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   └── app.js
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php
│       │   └── guest.blade.php
│       ├── profile/
│       │   ├── edit.blade.php
│       │   └── partials/
│       │       ├── update-profile-information-form.blade.php
│       │       ├── update-password-form.blade.php
│       │       └── delete-user-form.blade.php
│       ├── loans/
│       │   ├── index.blade.php
│       │   └── create.blade.php
│       ├── customers/
│       └── components/
│           ├── danger-button.blade.php
│           └── modal.blade.php
├── routes/
│   ├── web.php
│   └── auth.php
├── storage/
│   ├── framework/
│   └── logs/
├── tests/
│   ├── Feature/
│   │   ├── RepaymentTest.php
│   │   └── Auth/
│   └── Unit/
└── vendor/


> Note: This file was created in the working tree on branch `ui-improvements` and is not yet committed. Reply `commit` and I'll add, commit, and push it for you (or reply `no` to leave it uncommitted).