<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default borrow period (days)
    |--------------------------------------------------------------------------
    */
    'borrow_days' => (int) env('BORROW_DAYS', 14),

    /*
    |--------------------------------------------------------------------------
    | Due reminder: send reminder this many days before due date
    |--------------------------------------------------------------------------
    */
    'due_reminder_days_before' => (int) env('DUE_REMINDER_DAYS_BEFORE', 1),

];
