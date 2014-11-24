<?php namespace Xjchen\Tencdn\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Publish extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'tencdn:publish';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Publish local resources to tencent cdn.';

	/**
	 * Create a new command instance.
	 *
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->info('fill the exact commands');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(

		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(

		);
	}

}
