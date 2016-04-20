<?php

return Symfony\CS\Config\Config::create()
    ->level(Symfony\CS\FixerInterface::SYMFONY_LEVEL)
    ->fixers([
        '-psr0',
        '-concat_without_spaces',
        '-multiline_array_trailing_comma',
        '-pre_increment',
        '-unalign_double_arrow',
        '-phpdoc_to_comment',
        'align_double_arrow',
        'concat_with_spaces',
        'phpdoc_order',
        'short_array_syntax'
    ]);