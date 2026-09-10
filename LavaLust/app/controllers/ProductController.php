public function store()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    echo "<pre>";

    if ($this->io->method() !== 'post') {
        echo "ERROR: Request is not POST.";
        exit;
    }

    $data = array(
        'name'        => $this->io->post('product_name'),
        'description' => $this->io->post('description'),
        'price'       => $this->io->post('price'),
        'quantity'    => $this->io->post('quantity')
    );

    echo "DATA BEING SAVED:\n";
    print_r($data);

    echo "\n\nTrying to save...\n";

    $result = $this->ProductModel->create($data);

    echo "\nDatabase result:\n";
    var_dump($result);

    echo "\n\nIf you see this message, database insert finished.";
    exit;
}