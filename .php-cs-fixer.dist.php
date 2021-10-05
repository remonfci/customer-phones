<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\LanguageConstruct\SingleSpaceAfterConstructFixer;

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/app')
    ->in(__DIR__ . '/config')
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/tests')
;

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR2' => true,
        '@PSR12' => true,
        '@PHP80Migration' => true,
        '@PhpCsFixer' => true,

        'array_syntax' => ['syntax' => 'short'],
        'concat_space' => ['spacing' => 'one'],
        'yoda_style' => false,
        'general_phpdoc_annotation_remove' => ['annotations' => ['author', 'package']],

        // $i++ should be valid
        'increment_style' => false,

        // Disabled because of unnecessary new line between ORM annotations and type on properties
        'phpdoc_separation' => false,

        // Disabled, because we use docblock annotations for inline variable definitions
        'phpdoc_to_comment' => false,

        'no_break_comment' => true,
        'elseif' => true,
        'no_leading_import_slash' => true,
        'no_leading_namespace_whitespace' => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_singleline_whitespace_before_semicolons' => true,
        'no_spaces_after_function_name' => true,
        'no_spaces_inside_parenthesis' => true,
        'no_trailing_comma_in_list_call' => true,
        'no_trailing_comma_in_singleline_array' => true,
        'no_trailing_whitespace' => true,
        'no_unused_imports' => true,
        'no_whitespace_in_blank_line' => true,
        'not_operator_with_successor_space' => true,
        'object_operator_without_whitespace' => true,
        'phpdoc_align' => true,
        'phpdoc_indent' => true,
        'phpdoc_no_access' => true,
        'phpdoc_no_package' => true,
        'phpdoc_order' => true,
        'phpdoc_scalar' => true,
        'phpdoc_summary' => true,
        'phpdoc_trim' => true,
        'phpdoc_var_without_name' => true,
        'self_accessor' => true,
        'simplified_null_return' => true,
        'single_blank_line_at_eof' => true,
        'single_blank_line_before_namespace' => true,
        'single_import_per_statement' => true,
        'single_line_after_imports' => true,
        'single_quote' => true,
        'standardize_not_equals' => true,
        'ternary_operator_spaces' => true,
        'trim_array_spaces' => true,
        'unary_operator_spaces' => true,
        'visibility_required' => true,
        'encoding' => true,
        'full_opening_tag' => true,
        'function_declaration' => true,
        'function_typehint_space' => true,
        'include' => true,
        'indentation_type' => true,
        'line_ending' => true,
        'lowercase_keywords' => true,
        'method_argument_space' => true,
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => true,
        'no_closing_tag' => true,
        'no_empty_statement' => true,

        // Automatically import FQCNs
        'fully_qualified_strict_types' => true,

        // Do not remove space after attributes, as otherwise an method attributes are combined with the method signature
        // into a single line
        'single_space_after_construct' => ['constructs' => (function () {
            return array_diff(array_keys(self::$tokenMap), ['attribute']);
        })->bindTo(null, SingleSpaceAfterConstructFixer::class)()],

        // Enforce the usage of strict_types in any file  (risky) and if strict_types is not desired, it must contain strict_types=0
        'declare_strict_types' => true,

        // Union types should not have a space
        'binary_operator_spaces' => [
            'operators' => [
                '|' => 'no_space',
            ],
        ],

        // Not necessary?
        'php_unit_test_class_requires_covers' => false,
        'php_unit_internal_class' => false,

        /** There MUST be one blank line after the namespace declaration. */
        'blank_line_after_namespace' => true,

        /** Ensure there is no code on the same line as the PHP open tag and it is followed by a blank line. */
        'blank_line_after_opening_tag' => true,

        /** An empty line feed must precede any configured statement. */
        'blank_line_before_statement' => [
            'statements' => ['return']
        ],

        /** The body of each structure MUST be enclosed by braces. Braces should be properly placed. Body of braces should be properly indented. */
        'braces' => true,

        /** A single space or none should be between cast and variable. */
        'cast_spaces' => true,

        /** Whitespace around the keywords of a class, trait or interfaces definition should be one space. */
        'class_definition' => true,

        /** Equal sign in declare statement should be surrounded by spaces or not following configuration. */
        'declare_equal_normalize' => true,

        /** Convert heredoc to nowdoc where possible. */
        'heredoc_to_nowdoc' => true,

        /** Ensure there is no code on the same line as the PHP open tag. */
        'linebreak_after_opening_tag' => true,

        /** Cast should be written in lower case. */
        'lowercase_cast' => true,

        /** Class static references self, static and parent MUST be in lower case. */
        'lowercase_static_reference' => true,

        /** Magic method definitions and calls must be using the correct casing. */
        'magic_method_casing' => true,

        /** Magic constants should be referred to using the correct casing */
        'magic_constant_casing' => true,

        /** Function defined by PHP should be called using the correct casing. */
        'native_function_casing' => true,

        /** (risky) Master functions shall be used instead of aliases. */
        'no_alias_functions' => true,

        /** Removes extra blank lines and/or blank lines following configuration. */
        'no_extra_blank_lines' => [
            'tokens' => [
                'extra',
                'throw',
                'use',
                'use_trait',
            ]
        ],
        'no_empty_phpdoc' => true,
        'no_mixed_echo_print' => [
            'use' => 'echo'
        ],
        'multiline_whitespace_before_semicolons' => [
            'strategy' => 'no_multi_line'
        ],
        'no_short_bool_cast' => true,
        'no_spaces_around_offset' => true,
        'no_trailing_whitespace_in_comment' => true,
        'no_unneeded_control_parentheses' => true,
        'no_unreachable_default_argument_value' => true,
        'no_useless_return' => true,
        'no_whitespace_before_comma_in_array' => true,
        'normalize_index_brace' => true,
        'phpdoc_no_useless_inheritdoc' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_types' => true,
        'short_scalar_cast' => true,
        'single_class_element_per_statement' => true,
        'single_line_comment_style' => [
            'comment_types' => ['hash']
        ],
        'space_after_semicolon' => true,
        'switch_case_semicolon_to_colon' => true,
        'switch_case_space' => true,
        'whitespace_after_comma_in_array' => true,
    ])
    ->setFinder($finder)
;
