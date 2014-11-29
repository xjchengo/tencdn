<?php namespace Xjchen\Tencdn\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Config;

class Publish extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'tencdn:publish';
	protected $files;
	protected $password;
	protected $local_path;
	protected $url;
	protected $username;

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Publish local resources to tencent cdn.';

	//$this->username = Config::get('tencdn::svn.username');
	//$this->password = Config::get('tencdn::svn.password');
	//$this->local_path = Config::get('tencdn::svn.local_resource_path');
	//$this->url = Config::get('tencdn::svn.url');
	//protected $file;
	//$file = $this->argument('file');

	/**
	 * Create a new command instance.
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->username = Config::get('tencdn::svn.username');
	    $this->password = Config::get('tencdn::svn.password');
	    $this->local_path = Config::get('tencdn::svn.local_resource_path');
	    $this->url = Config::get('tencdn::svn.url');

	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->files=$this->argument('files');
		//$this->info('fill the exact commands');
		svn_auth_set_parameter(SVN_AUTH_PARAM_DEFAULT_USERNAME, $this->username);
		svn_auth_set_parameter(SVN_AUTH_PARAM_DEFAULT_PASSWORD, $this->password);

		svn_checkout($this->url,$this->local_path);

		if(!is_null($this->files))
			foreach ($this->files as $file) {
				exec("cp -rf $file $this->local_path");
			}
			

		$output = svn_add($this->local_path,true,true);
		if($output != true){
			$this->error('failed to add file to svn');
			return false;
		}
		$output = svn_commit('Successfuly Commit',array($this->local_path));
		if(!is_int($output[0])){
			$this->error('failed to commit file to svn');
			return false;
		}
		return true;
		}
		



	
	/**
	 * Execute the shell command.
	 */
	

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			[
				'files',
				 InputArgument::IS_ARRAY | InputArgument::OPTIONAL,
				'file or directory to be added, current user should have write permission on it'
				],

		];
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
