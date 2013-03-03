<?php
$colors = array(
	'Blue',
	'Green',
	'Black',
	'Purple',
	'Yellow'
);

$content = array(
	'test-fields' => array(
		'title' => 'Testing Fields',
		'type' => 'fieldset',
		'elements' => array(
			'cover-letter' => array(
				'label' => 'Cover Letter',
				'tip' => 'We are only accepting PDF format.',
				'type' => 'file',
				'accept_types' => array( 'pdf' )
			),
			'fav-color' => array(
				'type' => 'checklist',
				'label' => 'Favorite Color',
				'options' => array_combine( $colors, $colors )
			),
			'birthday' => array(
				'type' => 'date',
				'label' => 'Birthday',
				'data-date-format' => 'yy/mm/dd'
			),
			'background-image' => array(
				'label' => 'Background Image',
				'type' => 'image',
				'versions' => array(
					'medium' => array(
						'width' => 1024,
						'height' => 768
					),
					'square' => array(
						'width' => 300,
						'height' => 300,
						'crop' => array( 'center', 'top' )
					),
					'square@2x' => array(
						'width' => 600,
						'height' => 600,
						'crop' => array( 'center', 'top' )
					)
				)
			)
		)
	),
	'page' => array(
		'type' => 'fieldset',
		'elements' => array(
			'title' => array(
				'type' => 'text',
				'label' => 'Page Title',
				'required' => true,
				'autofocus' => true,
				'tip' => 'This is the title displayed on your page.'
			),
			'photo' => array(
				'label' => 'Photo',
				'type' => 'image',
				'versions' => array(
					'square' => array(
						'width' => 300,
						'height' => 300,
						'crop' => array( 'center', 'top' )
					),
					'square@2x' => array(
						'width' => 600,
						'height' => 600,
						'crop' => array( 'center', 'top' )
					)
				)
			),
			'intro-paragraph' => array(
				'type' => 'wysiwyg',
				'class' => 'input-block-level',
				'label' => 'Content',
				'rows' => 14,
				'required' => true,
				'tip' => 'This is the text displayed on your page.'
			)
		)
	),
	'movies' => array(
		'type' => 'repeatable',
		'title' => 'Movies',
		'description' => 'Consume all the Sam Jackson movies!',
		'empty-to-show' => 3,
		'elements' => array(
			'show' => array(
				'label' => 'Show/hide',
				'type' => 'checkbox',
				'title' => 'Check to show on site'
			),
			'title' => array(
				'type' => 'text',
				'label' => 'Title'
			),
			'url' => array(
				'type' => 'url',
				'class' => 'input-block-level',
				'label' => 'IMDB URL'
			),
			'stars' => array(
				'type' => 'select',
				'label' => 'Rating',
				'options' => array(
					'' => 'Star Rating',
					'1' => '1/5',
					'2' => '2/5',
					'3' => '3/5',
					'4' => '4/5',
					'5' => '5/5'
				)
			)
		)
	),
	'left-button' => array(
		'type' => 'fieldset',
		'elements' => array(
			'text' => array(
				'type' => 'text',
				'label' => 'Left Button Text',
				'required' => true,
				'tip' => 'The text for the left hand button link.'
			),
			'url' => array(
				'type' => 'url',
				'label' => 'Left Button Link',
				'required' => true,
				'tip' => 'The link for the left hand button.',
				'class' => 'input-block-level'
			)
		)
	),
	'right-button' => array(
		'type' => 'fieldset',
		'elements' => array(
			'text' => array(
				'type' => 'text',
				'label' => 'Right Button Text',
				'required' => true,
				'tip' => 'The text for the right hand button link.'
			),
			'url' => array(
				'type' => 'url',
				'label' => 'Right Button Link',
				'required' => true,
				'tip' => 'The link for the right hand button.',
				'class' => 'input-block-level'
			)
		)
	)
);
