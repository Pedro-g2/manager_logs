<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

// Localiza os arquivos no projeto
$finder = Finder::create()
    ->in(__DIR__)
    ->name('*.php')
    ->notName('*.blade.php') // Ignora arquivos Blade se usar Laravel
    ->ignoreDotFiles(true)
    ->ignoreVCS(true)
    ->exclude([
        'vendor',
        'node_modules',
        'storage',
        'bootstrap/cache',
    ]);

$config = new Config();

return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true, // Aplica todas as regras da PSR-12
        'array_syntax' => ['syntax' => 'short'], // Força arrays curtos [] (padrão moderno)
        'no_unused_imports' => true, // Remove imports (use) não utilizados
        'ordered_imports' => ['sort_algorithm' => 'alpha'], // Ordena imports alfabeticamente
    ])
    ->setFinder($finder);