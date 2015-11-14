<?php

class WMetadata extends CApplicationComponent {

    /**
     * Get all information about application
     * if modules of your application have controllers with same name, it will raise fatall error
     * 
     */
    public function getAll() {

        $meta = array();
        $controllers = array();
        foreach ($this->getControllers() as $controller) {
            $controllers[] = array(
                'name' => $controller,
                'actions' => $this->getActions($controller)
            );
        }

        $meta['controllers'] = $controllers;


        $modules = array();
        foreach ($this->getModules() as $module) {

            $controllers = array();

            foreach ($this->getControllers($module) as $controller) {
                $controllers[] = array(
                    'name' => $controller,
                    'actions' => $this->getActions($controller, $module)
                );
            }


            $modules[] = array(
                'name' => $module,
                'controllers' => $controllers,
            );
        }
        $meta['modules'] = $modules;

        return $meta;
    }

    /**
     * Get actions of controller
     * 
     * @param mixed $controller
     * @param mixed $module
     * @return mixed
     */
    public function getActions($controller, $module = null) {
        $path = ($module === NULL) ? 'application.controllers.' : 'application.modules.' . $module . '.controllers.';
        $controller = ucfirst($controller . 'Controller');
        $actions = array();
        $file = fopen(Yii::getPathOfAlias($path . $controller) . '.php', 'r');
        $lineNumber = 0;
        while (feof($file) === false) {
            ++$lineNumber;
            $line = fgets($file);
            preg_match('/public[ \t]+function[ \t]+action([A-Z]{1}[a-zA-Z0-9]+)[ \t]*\(/', $line, $matches);
            if ($matches !== array()) {
                $name = $matches[1];
                $actions[] = lcfirst($name);
            }
        }
        return $actions;
    }

    /**
     * Get list of controllers with actions
     * 
     * @param mixed $module
     * @return array
     */
    function getControllersActions($module = null) {
        $c = $this->getControllers($module);
        foreach ($c as &$controller) {
            $controller = array(
                'name' => $controller,
                'actions' => $this->getActions($controller, $module)
            );
        }
        return $c;
    }

    /**
     * Scans controller directory & return array of MVC controllers
     * 
     * @param mixed $module
     * @param mixed $include_classes
     * @return array
     */
    public function getControllers($module = null) {
        $path = ($module === NULL) ? Yii::getPathOfAlias('application.controllers') : Yii::getPathOfAlias('application.modules.' . $module . '.controllers');
        $iterator = new FilesystemIterator($path);
        $filter = new RegexIterator($iterator, '/Controller.php$/');
        $controllers = array();
        foreach ($filter as $entry) {
            $controllers[] = lcfirst(str_replace('Controller.php', '', $entry->getFilename()));
        }
        return $controllers;
    }

    /**
     * Returns array of module names
     * 
     */
    public function getModules() {
        $iterator = new FilesystemIterator(Yii::getPathOfAlias('application.modules'));
        $modules = array();
        foreach ($iterator as $entry) {
            if ($entry->isDir() && file_exists($entry->getPathname() . DIRECTORY_SEPARATOR . ucfirst($entry->getFilename()) . 'Module.php'))
                $modules[] = $entry->getFilename();
        }
        return $modules;
    }

}
