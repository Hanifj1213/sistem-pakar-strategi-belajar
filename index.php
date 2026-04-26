<?php declare(strict_types=1);

require __DIR__ . '/app/helpers.php';
require __DIR__ . '/app/Database.php';
require __DIR__ . '/app/Utils/Validation.php';
require __DIR__ . '/app/Services/FuzzyService.php';
require __DIR__ . '/app/Repositories/AssessmentRepository.php';
require __DIR__ . '/app/Controllers/ApiController.php';

$pdo = Database::getConnection();
$repository = new AssessmentRepository($pdo);
$fuzzyService = new FuzzyService();
$apiController = new ApiController($repository, $fuzzyService);

$scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$basePath = rtrim($scriptName, '/');
if ($basePath === '/') {
    $basePath = '';
}

$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

// Normalisasi URL encoded (mis. folder dengan spasi: %20) agar cocok saat strip basePath.
$normalizedRequestPath = rawurldecode($requestPath);
$normalizedBasePath = rawurldecode($basePath);

if ($normalizedBasePath !== '' && str_starts_with($normalizedRequestPath, $normalizedBasePath)) {
    $requestPath = substr($normalizedRequestPath, strlen($normalizedBasePath));
} else {
    $requestPath = $normalizedRequestPath;
}
$requestPath = '/' . ltrim($requestPath, '/');
$requestPath = $requestPath === '//' ? '/' : $requestPath;

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($method === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if (str_starts_with($requestPath, '/api')) {
    if ($requestPath === '/api' || $requestPath === '/api/') {
        if ($method === 'GET') {
            $apiController->health();
        }
        jsonResponse(['success' => false, 'message' => 'Method tidak diizinkan'], 405);
    }

    if (preg_match('#^/api/assessments/?$#', $requestPath)) {
        if ($method === 'POST') {
            $apiController->createAssessment(readJsonBody());
        }
        if ($method === 'GET') {
            $apiController->getAllAssessments();
        }
        jsonResponse(['success' => false, 'message' => 'Method tidak diizinkan'], 405);
    }

    if (preg_match('#^/api/assessments/(\d+)/?$#', $requestPath, $matches)) {
        $id = (int) $matches[1];

        if ($method === 'GET') {
            $apiController->getAssessmentById($id);
        }

        if ($method === 'DELETE') {
            $apiController->deleteAssessment($id);
        }

        jsonResponse(['success' => false, 'message' => 'Method tidak diizinkan'], 405);
    }

    jsonResponse(['success' => false, 'message' => 'Endpoint API tidak ditemukan'], 404);
}

$title = 'Sistem Fuzzy Kesiapan Belajar Mahasiswa';
$currentPath = $requestPath;
$viewFile = null;

if ($requestPath === '/') {
    $viewFile = __DIR__ . '/views/pages/home.php';
} elseif ($requestPath === '/assessment') {
    $title = 'Penilaian Kesiapan';
    $viewFile = __DIR__ . '/views/pages/assessment.php';
} elseif ($requestPath === '/history') {
    $title = 'Riwayat Assessment';
    $viewFile = __DIR__ . '/views/pages/history.php';
} elseif (preg_match('#^/detail/(\d+)/?$#', $requestPath, $matches)) {
    $title = 'Detail Assessment';
    $assessmentId = (int) $matches[1];
    $viewFile = __DIR__ . '/views/pages/detail.php';
} else {
    http_response_code(404);
    $title = '404 - Halaman Tidak Ditemukan';
    $viewFile = __DIR__ . '/views/pages/not-found.php';
}

require __DIR__ . '/views/layout.php';
