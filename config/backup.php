<?php

return [

    'backup' => [

        'name' => env('APP_NAME', 'laravel-backup'),

        'source' => [

            'files' => [

                /*
                 * Empty — no file backups, database only.
                 */
                'include' => [
                    storage_path('app/public'),
                ],

                'exclude' => [
                    base_path('vendor'),
                    base_path('node_modules'),
                ],

                'follow_links' => false,

                'ignore_unreadable_directories' => false,

                'relative_path' => null,
            ],

            /*
             * Only backup the MySQL database.
             */
            'databases' => [
                'mysql',
            ],
        ],

        'database_dump_compressor' => null,

        'database_dump_file_timestamp_format' => null,

        'database_dump_filename_base' => 'database',

        'database_dump_file_extension' => '',

        'destination' => [

            'filename_prefix' => '',

            /*
             * Store backups in the db_backup disk (project root /db_backup).
             */
            'disks' => [
                'backups',
            ],
        ],

        'temporary_directory' => storage_path('app/backup-temp'),

        'password' => env('BACKUP_ARCHIVE_PASSWORD'),

        'encryption' => 'default',
    ],

    /*
     * Disable all notifications — dev environment, manual backups only.
     */
    'notifications' => [

        'notifications' => [
            \Spatie\Backup\Notifications\Notifications\BackupHasFailedNotification::class => [],
            \Spatie\Backup\Notifications\Notifications\UnhealthyBackupWasFoundNotification::class => [],
            \Spatie\Backup\Notifications\Notifications\CleanupHasFailedNotification::class => [],
            \Spatie\Backup\Notifications\Notifications\BackupWasSuccessfulNotification::class => [],
            \Spatie\Backup\Notifications\Notifications\HealthyBackupWasFoundNotification::class => [],
            \Spatie\Backup\Notifications\Notifications\CleanupWasSuccessfulNotification::class => [],
        ],

        'notifiable' => \Spatie\Backup\Notifications\Notifiable::class,

        'mail' => [
            'to' => 'your@example.com',

            'from' => [
                'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
                'name' => env('MAIL_FROM_NAME', 'Example'),
            ],
        ],

        'slack' => [
            'webhook_url' => '',
            'channel' => null,
            'username' => null,
            'icon' => null,
        ],

        'discord' => [
            'webhook_url' => '',
            'username' => '',
            'avatar_url' => '',
        ],
    ],

    /*
     * Disable monitoring — dev environment.
     */
    'monitor_backups' => [
        [
            'name' => env('APP_NAME', 'laravel-backup'),
            'disks' => ['backups'],
            'health_checks' => [
                \Spatie\Backup\Tasks\Monitor\HealthChecks\MaximumAgeInDays::class => 1,
                \Spatie\Backup\Tasks\Monitor\HealthChecks\MaximumStorageInMegabytes::class => 5000,
            ],
        ],
    ],

    'cleanup' => [
        'strategy' => \Spatie\Backup\Tasks\Cleanup\Strategies\DefaultStrategy::class,

        'default_strategy' => [

            'keep_all_backups_for_days' => 7,

            'keep_daily_backups_for_days' => 16,

            'keep_weekly_backups_for_weeks' => 8,

            'keep_monthly_backups_for_months' => 4,

            'keep_yearly_backups_for_years' => 2,

            'delete_oldest_backups_when_using_more_megabytes_than' => 5000,
        ],
    ],
];
