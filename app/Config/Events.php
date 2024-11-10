<?php

namespace Config;

use CodeIgniter\Events\Events;
use CodeIgniter\Exceptions\FrameworkException;
use CodeIgniter\HotReloader\HotReloader;

/*
 * --------------------------------------------------------------------
 * Application Events
 * --------------------------------------------------------------------
 * Events allow you to tap into the execution of the program without
 * modifying or extending core files. This file provides a central
 * location to define your events, though they can always be added
 * at run-time, also, if needed.
 *
 * You create code that can execute by subscribing to events with
 * the 'on()' method. This accepts any form of callable, including
 * Closures, that will be executed when the event is triggered.
 *
 * Example:
 *      Events::on('create', [$myInstance, 'myMethod']);
 */

Events::on('pre_system', static function (): void {
    if (ENVIRONMENT !== 'testing') {
        if (ini_get('zlib.output_compression')) {
            throw FrameworkException::forEnabledZlibOutputCompression();
        }

        while (ob_get_level() > 0) {
            ob_end_flush();
        }

        ob_start(static fn($buffer) => $buffer);
    }

    /*
     * --------------------------------------------------------------------
     * Debug Toolbar Listeners.
     * --------------------------------------------------------------------
     * If you delete, they will no longer be collected.
     */
    if (CI_DEBUG && ! is_cli()) {
        Events::on('DBQuery', 'CodeIgniter\Debug\Toolbar\Collectors\Database::collect');
        Services::toolbar()->respond();
        // Hot Reload route - for framework use on the hot reloader.
        if (ENVIRONMENT === 'development') {
            Services::routes()->get('__hot-reload', static function (): void {
                (new HotReloader())->run();
            });
        }
    }
});


// Events::on('DBQuery', function($query) {
//     $db = \Config\Database::connect();


//     $table_name = getTableNameFromQuery($query);
//     $builder = $db->table('logs');
//     $user_id = session()->get('user_id') ?? null;

//     $builder->insert([
//         'action' => 'query',
//         'table_name' => $table_name,
//         'record_id' => null,
//         'user_id' => $user_id,
//         'query' => $query,
//     ]);
// });

// /**
//  *
//  * @param string $query
//  * @return string|null
//  */
// function getTableNameFromQuery($query)
// {
//     // استخراج نام جدول پس از کلمات کلیدی INSERT INTO، UPDATE، DELETE FROM یا SELECT * FROM
//     if (preg_match('/\b(?:FROM|INTO|UPDATE)\s+`?(\w+)`?/i', $query, $matches)) {
//         return $matches[1];
//     }

//     return null;
// }