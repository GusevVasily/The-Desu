<?php
if (!defined('BYPASS')) exit(header('Location: /'));

$level_info     =  array(
	'level'     => 0,
	'name'      => 'Пролог',
	'completed' => false
);
$level_data     =  array(
	array(
		'type'  => 'next',
		'bg'    => 'semen_room',
		'img'   => '1',
		'name'  => '',
		'title' => 'Мне опять снился сон...'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => '<i>Этот</i> сон...'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Каждую ночь одно и то же.'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Но на утро, как обычно, всё забудется'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Может быть, оно и к лучшему...'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Остались только туманные воспоминания о приоткрытых, словно приглашающих куда-то воротах, рядом с которыми в камне застыли два пионера.'
	),
	array(
		'type'  => 'next',
		'flags' => 'autosave',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '2',
		'name'  => '',
		'title' => 'А ещё странная девочка... которая постоянно спрашивает:'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '...',
		'title' => 'Ты пойдёшь со мной?'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Пойду?..'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Но куда?'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'И зчем?..'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Да и где я вообще нахожусь?'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Конечно, случилось всё на самом деле, наяву, стоило бы непременно испугаться.'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Как же иначе!'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Но это - всего лишь сон. Тот самый, который я вижу каждую ночь.'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'А ведь всё это неспроста!'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Обязательно знать <i>где</i> и <i>почему</i>, чтобы понять - что-то происходит.'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Нечто, отчаянно требующее моего внимания.'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Ведь всё окружающее меня здесь - реально!'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Реальный настолько, насколько реальны мои вещи в квартире; я бы мог открыть варота, услышать скрип петель, смахнуть рукй осыпающуюся ржавчину, потянуть носом свежий прохладный воздух и поёжиться от холода.'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Мог бы, но для этого надо сдвинуться с места, сделать шаг, пошевелить рукой...'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'А ведь это сон - я понимаю, но что дальше, что изменит моё <i>понимание</i>?'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Ведь здесь - словно по ту сторону потрескавшегося экрана старого телевизора, который из последних сил борется с помехами и силится показать зрителям всё, не упустив ни малейшей детали.'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Но вот картинка теряет чёткость... Наверное, скоро просыпаться.'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Может быть, спросить у неё что-то? У девочки.'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Как же её зовут...'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Например про звёзды...'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Хотя почему про звёзды?'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Можно же спросить про ворота! Да, про ворота!'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Вот она удивится.'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Или лучше про букву <i>ё</i>.'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Хорошая была буква...'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Как будто её больше нет!'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'И какое отношение буквы, ворота и звёзды имеют к этому месту?'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Ведь, если мне каждую ночь снится <i>этот</i> сон, который потом всё равно забудется, надо искать разгадку здесь и сейчас!'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'А вот, если присмотреться, можно увидеть Магелланово Облако...'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Словно попал в южное полушарие!'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => '...'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Во сне всегда больше волнуют велочи: неестественный цвет травы, невозможная кривизна прямых или своё перекошенное отражение - а реальная опасность, готовая оборвать всё здесь и сейчас, кажется пустяком.'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Естественно, ведь <i>здесь</i> нельзя умереть.'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Я точно знаю - я делал это сотни раз.'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Но если нельзя умереть, нет смысла жить?'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Надо будет спросить у девочки: она местная - должна знать!'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Да, именно! Спросить, например, про сову.'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Больно уж птица странная...'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'А впрочем, неважно...'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => '...'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name' => '...',
		'title' => 'Ты пойдёшь со мной?'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'И каждый раз надо отвечать.'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Иначе никак, иначе сон не закончится, а я - не проснусь.'
	),
	array(
		'type'  => 'option',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '',
		'name'  => '',
		'title' => '',
		'options'       => array(
			'select'    => array(
				'count' => 2,
				'1'     => 'Пойти за ней.',
				'2'     => 'Нет, я останусь здесь.'
			),
			'points' => array(
				'1'  => '...:2',
				'2'  => '...:3'
			),
			'option_1'      => array(
				array(
					'type'  => 'next',
					'bg'    => 'ext_camp_entrance_night',
					'img'   => '',
					'name'  => '...',
					'title' => 'test1-1'
				),
				array(
					'type'  => 'next',
					'bg'    => 'ext_camp_entrance_night',
					'img'   => '',
					'name'  => '...',
					'title' => 'test1-2'
				),
				array(
					'type'  => 'next',
					'bg'    => 'ext_camp_entrance_night',
					'img'   => '',
					'name'  => '...',
					'title' => 'test1-3'
				)
			),
			'option_2'      => array(
				array(
					'type'  => 'next',
					'bg'    => 'ext_camp_entrance_night',
					'img'   => '',
					'name'  => '...',
					'title' => 'test2-1'
				),
				array(
					'type'  => 'next',
					'bg'    => 'ext_camp_entrance_night',
					'img'   => '',
					'name'  => '...',
					'title' => 'test2-3'
				),
				array(
					'type'  => 'next',
					'bg'    => 'ext_camp_entrance_night',
					'img'   => '',
					'name'  => '...',
					'title' => 'test2-3'
				)
			)
		)
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Каждый раз так сложно решить, что же ответить.'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Где я, что я здесь делаю, кто она такая?'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'И почему от ответа на этот вопрос зависит так много в моей жизни?'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Или не зависит?..'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Ведь это просто сон...'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_camp_entrance_night',
		'img'   => '1',
		'name'  => '',
		'title' => 'Просто сон...'
	),
	array(
		'type'  => 'next',
		'bg'    => 'ext_road_day',
		'img'   => '1',
		'name'  => '',
		'title' => '[Продолжение следует...]'
	),
	array(
		'type'  => 'new_level',
		'bg'    => 'ext_road_day',
		'img'   => '1',
		'name'  => '',
		'title' => '[Продолжение следует...]'
	)
);
