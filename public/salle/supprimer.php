<?php

use repository\SalleRepository;

require_once '../../src/repository/SalleRepository.php';
$id = (int)($_GET['id'] ?? 0);
if ($id) (new SalleRepository())->desactiver($id);
header('Location: liste.php?msg=ok'); exit;
