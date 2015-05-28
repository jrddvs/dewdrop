<?php

/**
 * Dewdrop
 *
 * @link      https://github.com/DeltaSystems/dewdrop
 * @copyright Delta Systems (http://deltasys.com)
 * @license   https://github.com/DeltaSystems/dewdrop/LICENSE
 */

namespace Dewdrop\Admin\PageFactory;

use Dewdrop\Admin\Component\ComponentAbstract;
use Dewdrop\Admin\Component\CrudInterface;
use ReflectionClass;

/**
 * Page factory for CRUD-capable components.  Provides a lot of CRUD functionality
 * without the need for per-component page files.  You can override any of these
 * pages by adding a file to your component (see Files page factory) and can disable
 * some of the provided functionality via your component's permissions.
 */
class Crud implements PageFactoryInterface
{
    /**
     * The component the pages will be provided for.
     *
     * @var CrudInterface|ComponentAbstract
     */
    protected $component;

    /**
     * The map of URL names to page classes this factory serves.
     *
     * @var array
     */
    protected $pageClassMap = [
        'adjust-visibility'  => '\Dewdrop\Admin\Page\Stock\AdjustVisibility',
        'counts'             => '\Dewdrop\Admin\Page\Stock\Counts',
        'debug-fields'       => '\Dewdrop\Admin\Page\Stock\DebugFields',
        'debug-listing-sql'  => '\Dewdrop\Admin\Page\Stock\DebugListingSql',
        'debug-pages'        => '\Dewdrop\Admin\Page\Stock\DebugPages',
        'debug-test-sorting' => '\Dewdrop\Admin\Page\Stock\DebugTestSorting',
        'delete'             => '\Dewdrop\Admin\Page\Stock\Delete',
        'edit'               => '\Dewdrop\Admin\Page\Stock\Edit',
        'export'             => '\Dewdrop\Admin\Page\Stock\Export',
        'index'              => '\Dewdrop\Admin\Page\Stock\Index',
        'notification-edit'  => '\Dewdrop\Admin\Page\Stock\NotificationEdit',
        'notifications'      => '\Dewdrop\Admin\Page\Stock\Notifications',
        'sort-fields'        => '\Dewdrop\Admin\Page\Stock\SortFields',
        'sort-listing'       => '\Dewdrop\Admin\Page\Stock\SortListing',
        'view'               => '\Dewdrop\Admin\Page\Stock\View'
    ];

    /**
     * Provide the component for which the pages will be generated.
     *
     * @param CrudInterface $component
     */
    public function __construct(CrudInterface $component)
    {
        $this->component = $component;
    }

    /**
     * Returns a page instance for the given name or false on failure
     *
     * @param string $name
     * @return \Dewdrop\Admin\Page\PageAbstract|false
     */
    public function createPage($name)
    {
        // Remain compatible with WP style naming
        $name = $this->component->getInflector()->hyphenize($name);

        if (array_key_exists($name, $this->pageClassMap)) {
            $pageClass      = $this->pageClassMap[$name];
            $reflectedClass = new ReflectionClass($pageClass);

            return new $pageClass(
                $this->component,
                $this->component->getRequest(),
                dirname($reflectedClass->getFileName()) . '/view-scripts'
            );
        }

        return false;
    }

    /**
     * List the pages this factory is capable of producing.
     *
     * @return array
     */
    public function listAvailablePages()
    {
        $pages = [];

        foreach ($this->pageClassMap as $urlName => $className) {
            $reflectedClass = new ReflectionClass($className);

            $pages[] = new Page($urlName, $reflectedClass->getFileName(), $className);
        }

        return $pages;
    }
}
