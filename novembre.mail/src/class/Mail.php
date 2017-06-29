<?php  namespace Novembre\Mail;

class Mail {

	private $options = array(
        layout_path => "/templates/views/layouts",
        template_path => "/templates/views/mails",
        mjml_minified_path => "/dist/mail",
		subject => "*|PAGE TITLE|*",
		template => "example",
		layout => "mail",
		from => "",
		from_name => "",
		mjml => false
	);
	private $headers = array();
	private $assign = array();

	public function __construct()
	{
		$this->setFrom('no-reply@' . $_SERVER['SERVER_NAME']);
		$this->setFromName(get_bloginfo( 'name' ));
	}
	/* -----------------------------
		SETTERS
	   ----------------------------- */
	public function setOptions($v)
	{
		$this->options = array_merge($this->options, $v);
	}

	public function setOption($k, $v)
	{
		$this->options[$k] = $v;
	}

	public function setSubject($v)
	{
		$this->options["subject"] = $v;
	}

	public function setTemplate($v)
	{
		$this->options["template"] = $v;
	}

	public function setLayout($v)
	{
		$this->options["layout"] = $v;
	}

	public function setFrom($email)
	{
		$this->options['from'] = $email;
	}

	public function setFromName($name)
	{
		$this->options['from_name'] = $name;
	}

	public function setMjml($state)
	{
		$this->options['mjml'] = $state;
	}

	public function assign($v)
	{
		$this->assign = $v;
	}

	private function buildHeaders()
	{
		$this->headers = array_merge($this->headers, array("From: ".$this->options['from_name']." <".$this->options['from'].">" . "\r\n"));
	}

	public function send($user_email)
	{
		global $mail_content;

		add_filter ("wp_mail_content_type", "enable_html_mail");
		if(!$this->options['mjml']) :
			ob_start();
				foreach($this->assign as $k => $v)
					set_query_var( $k, $v );

				get_template_part($this->options['template_path'] . '/mail', $this->options['template']);

			$mail_content = ob_get_contents(); ob_end_clean();

			ob_start();
				get_template_part($this->options['layout_path'] . '/layout', $this->options['layout']);

			$message = ob_get_contents(); ob_end_clean();

		else:

			ob_start();
			foreach($this->assign as $k => $v)
				set_query_var( $k, $v );

			get_template_part($this->options['mjml_minified_path'] . '/mail', $this->options['template']);

			$message = ob_get_contents(); ob_end_clean();

		endif;

		$this->buildHeaders();

		wp_mail( $user_email, $this->options['subject'], $message, $this->headers );

		remove_filter( "wp_mail_content_type", "enable_html_mail" );
	}

	public function __destruct()
	{
		foreach($this->assign as $k => $v)
			set_query_var( $k, null );
	}
}
