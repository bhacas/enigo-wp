<?php
// This file is generated. Do not modify it manually.
return array(
	'build' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/hero-section',
		'version' => '0.1.0',
		'title' => 'Hero Section',
		'category' => 'widgets',
		'icon' => 'superhero',
		'description' => 'A custom hero section with a headline, description, and repeatable buttons.',
		'example' => array(
			
		),
		'attributes' => array(
			'headline' => array(
				'type' => 'string',
				'source' => 'html',
				'selector' => 'h1'
			),
			'description' => array(
				'type' => 'string',
				'source' => 'html',
				'selector' => 'p'
			),
			'buttons' => array(
				'type' => 'array',
				'default' => array(
					array(
						'text' => 'View our work',
						'url' => '#portfolio',
						'style' => 'primary'
					),
					array(
						'text' => 'Get a free quote',
						'url' => '#contact',
						'style' => 'secondary'
					)
				)
			)
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'hero-section',
		'editorScript' => 'file:./build/index.js',
		'editorStyle' => 'file:./build/index.css',
		'style' => 'file:./build/style-index.css'
	)
);
