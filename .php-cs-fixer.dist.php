<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
    ->exclude('vendor')
    ->exclude('api-gateway')
    ->exclude('src/Domain/Dto/Trading')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        'method_chaining_indentation' => true,
        'declare_strict_types' => true,
        'strict_comparison' => true,
        'phpdoc_no_useless_inheritdoc' => true,
        'concat_space' => ['spacing' => 'one'],
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true)
;
