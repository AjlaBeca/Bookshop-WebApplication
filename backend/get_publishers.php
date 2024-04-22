<?php
require_once __DIR__ . "/rest/services/PublisherService.class.php";

$publisherService = new PublisherService();
$publishers = $publisherService->fetchAll();

header('Content-Type: application/json');
echo json_encode($publishers);
?>
