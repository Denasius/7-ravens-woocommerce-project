<?php

add_action('widgets_init', 'f_collection');

function f_collection()
{
	register_widget('F_Collection');
}

class F_Collection extends WP_Widget{
	
	function F_Collection() {
		
		$widget_ops = array(
			'classname' => 'ravens',
			'description' => 'Описание'
		);
		$control_ops = array(
			'width' => 300,
			'height' => 350		
		);
		
		$this->WP_Widget('fcollection','Горячие товары',$widget_ops,$control_ops);
	}

	// метод необходим для изменения параметров виджета при обновлении. Переопределяемый.
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['pcount'] = strip_tags($new_instance['pcount']);

		return $instance;
	}

	// используется для отображения информации на экране пользователя
	public function widget($args, $instance)
	{
		$title = apply_filters('widget_title', $instance['title']);
		$pcount = $instance['pcount'];

		include "templ.php";
	}
	
	// инициализирует форму настройки параметров
	function form($instance) {
		
		$defaults = array(
			'title' => "What's hot's",
			'pcount' => 8
		);
		$instance = wp_parse_args((array)$instance, $defaults);	?>
	<p>
		
		<label for="<?php echo $this->get_field_id('title')?>">Заголовок</label>
		<input id="<?php echo $this->get_field_id('title')?>" name="<?php echo $this->get_field_name('title')?>" value="<?php echo $instance['title'];?>" style="width:100%;">
	</p>
	
	
	<p>
		
		<label for="<?php echo $this->get_field_id('pcount')?>">Кол-во элементов</label>
		<input id="<?php echo $this->get_field_id('pcount')?>" name="<?php echo $this->get_field_name('pcount')?>" value="<?php echo $instance['pcount'];?>" style="width:100%;">
	</p>
	
	<?php	
	}

	
}
?>