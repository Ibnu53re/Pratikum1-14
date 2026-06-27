<?php

namespace Config;

/**
 * Holds the path configurations for the application.
 */
class Paths
{
    /**
     * The path to the application directory.
     */
    public $appDirectory = APPPATH;

    /**
     * The path to the system directory.
     */
    public $systemDirectory = SYSTEMPATH;

    /**
     * The path to the public directory.
     */
    public $publicDirectory = FCPATH;

    /**
     * The path to the writable directory.
     */
    public $writableDirectory = WRITEPATH;

    /**
     * The path to the tests directory.
     */
    public $testsDirectory = TESTPATH;

    /**
     * The path to the root of the application.
     */
    public $rootDirectory = ROOTPATH;

    /**
     * The path to the view directory.
     */
    public $viewDirectory = APPPATH . 'Views';
}