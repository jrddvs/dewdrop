<?php

/**
 * Dewdrop
 *
 * @link      https://github.com/DeltaSystems/dewdrop
 * @copyright Delta Systems (http://deltasys.com)
 * @license   https://github.com/DeltaSystems/dewdrop/LICENSE
 */

namespace Dewdrop\Cli\Command;

/**
 * Run PHPUnit tests available for the Dewdrop library.
 */
class DewdropTest extends CommandAbstract
{
    /**
     * The location of the phpunit executable.  We'll attempt to auto-detect
     * this if it isn't set manually.
     *
     * @var string
     */
    protected $phpunit = null;

    /**
     * Where you'd like to generate an HTML code coverage report for the tests.
     *
     * @var string
     */
    protected $coverageHtml;

    /**
     * If/where you'd like to generate a JSON log of the tests
     *
     * @var string
     */
    protected $logJson;

    /**
     * Set basic command information, arguments and examples
     *
     * @inheritdoc
     */
    public function init()
    {
        $this
            ->setDescription("Run the Dewdrop library's unit tests")
            ->setCommand('dewdrop-test')
            ->addAlias('test-dewdrop')
            ->addAlias('phpunit-dewdrop');

        $this->addArg(
            'phpunit',
            'The location of the PHPUnit executable',
            self::ARG_OPTIONAL
        );

        $this->addArg(
            'coverage-html',
            "The location where you'd like to generate an HTML code coverage report",
            self::ARG_OPTIONAL
        );

        $this->addArg(
            'log-json',
            "The location where you'd like to geneartion a JSON test log",
            self::ARG_OPTIONAL
        );
    }

    /**
     * Manually set the path to the phpunit binary
     *
     * @param string $phpunit
     * @return \Dewdrop\Cli\Command\DewdropTest
     */
    public function setPhpunit($phpunit)
    {
        $this->phpunit = $phpunit;

        return $this;
    }

    /**
     * Set the path where you would like HTML code coverage reports to be
     * saved
     *
     * @param string $coverageHtml
     * @return \Dewdrop\Cli\Command\DewdropTest
     */
    public function setCoverageHtml($coverageHtml)
    {
        $this->coverageHtml = $coverageHtml;

        return $this;
    }

    /**
     * Set the path where you would like JSON test logs to be saved
     *
     * @param string $logJson
     * @return \Dewdrop\Cli\Command\DewdropTest
     */
    public function setLogJson($logJson)
    {
        $this->logJson = $logJson;

        return $this;
    }

    /**
     * Run PHPUnit on the Dewdrop library tests folder.
     *
     * @return void
     */
    public function execute()
    {
        if (null === $this->phpunit) {
            $this->phpunit = $this->autoDetectExecutable('phpunit');
        }

        $logJson = ' ';

        if (null !== $this->logJson) {
            $logJson = ' --log-json=' . escapeshellarg($this->evalPathArgument($this->logJson)) . ' ';
        }

        $testPath = $this->paths->getLib() . '/tests';

        $cmd = sprintf(
            '%s%s -c %s',
            $this->phpunit,
            $logJson,
            escapeshellarg($testPath . '/phpunit.xml')
        );

        if ($this->coverageHtml) {
            $cmd .= sprintf(
                ' --coverage-html=%s',
                escapeshellarg($this->evalPathArgument($this->coverageHtml))
            );
        }

        $cmd .= ' ' . escapeshellarg($testPath);

        $this->runner->halt($this->passthru($cmd));
    }
}