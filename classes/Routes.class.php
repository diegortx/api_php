<?php
/**
 * Responsable to manager all routes configs
 * @method function add(string $method, string $route, string $callback, bool $protected = false)
 * @method function go(string $route)
 */
class Routes
{
    private $listRoutes = array('');
    private $listCallback = array('');
    private $listProtected = array('');


    /**
     * Add a route using the specified HTTP method, URL pattern, and controller method.
     *
     * @param string $method The HTTP method for the route (e.g., "GET", "POST").
     * @param string $route The URL pattern to match for the route.
     * @param string $callback The controller method to be invoked for the route.
     * @param bool $protected The protectd is if your configure any control (e.g., "JWT","OAUTH2").
     *
     * @example
     * $route->add("GET", '/clientes/show', 'Clientes::show');
     *
     * This example demonstrates how to add a route to display client information using
     * the "Clientes" controller's "show" method. You can call this in your "index.php"
     * main path or wherever your routing configuration is set up.
     */
    public function add(string $method, string $route, string $callback, bool $protected = false)
    {
        $this->listRoutes[] = strtoupper($method) . ":" . $route;
        $this->listCallback[] = $callback;
        $this->listProtected[] = $protected;

        return $this;
    }

    /**
     * Call routes and populate for control and delivery correct path
     * 
     * @param string  $route Using to call how route you need
     */
    public function go(string $route)
    {
        $callback = '';
        $protected = '';
        $param = '';

        # Get method a request (e.g., "GET","POST")
        $method = $_SERVER['REQUEST_METHOD'];

        # Check the method if have array_key "_method" in "$_POST", if have set this or using main value from method
        $method = isset($_POST['_method']) ? $_POST['_method'] : $method;

        # Concat method with route (e.g., ("GET:/clientes/show"))
        $route = $method . ":/" . $route;


        # Check if route have more three "/" if yes have a params in route
        if (substr_count($route, '/') >= 3) {
            #Set just param value
            $param = substr($route, strrpos($route, '/') + 1);
            #Concat "/[param]" in route after last "/" (e.g., ("GET:/clientes/show/[param]"))
            $route = substr($route, 0, strrpos($route, '/')) . "/[param]";
        }

        # Search if a route calling have inside a list routes
        $index = array_search($route, $this->listRoutes);

        # If find a route in list
        if ($index > 0) {

            # Explode list callback in index, to Class and Method
            $callback = explode("::", $this->listCallback[$index]);

            # Check if this call have protection
            $protected = $this->listProtected[$index];
        }

        $class = isset($callback[0]) ? $callback[0] : '';
        $method = isset($callback[1]) ? $callback[1] : '';

        # Check if class exists
        if (class_exists($class)) {
            # Check if method exists inside the class
            if (method_exists($class, $method)) {

                # Intance the class
                $instanceClass = new $class();

                # Check if no have protection 
                if (!$protected) {
                    return call_user_func_array(
                        array($instanceClass, $method),
                        array($param)
                    );
                } else {
                    http_response_code(401);
                    echo json_encode(["error" => "user unauthorized"]);
                }
            }
        } else {
            http_response_code(404);
            echo json_encode(["error" => "route not found"]);
        }

    }
}