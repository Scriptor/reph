<?php
namespace reph;
require_once('/home/scriptor/pharen/lang.php');
use Pharen\Lexical as Lexical;
use \Seq as Seq;
use \FastSeq as FastSeq;
Lexical::$scopes['_reph'] = array();
include_once 'pharen/repl.php';
use pharen\repl as repl;
error_reporting(E_ALL);
set_time_limit(0);
ob_implicit_flush();
function get_repl_vars($file){
	if($file){
		$phpfile = str_replace(".phn", ".php", $file);
		return repl\get_file_vars($phpfile, arr(\PharenVector::create_from_array(array())));
	}
	else{
		return arr(\PharenVector::create_from_array(array()));
	}
}

function _reph__lambdafunc18($prompt_str, $__closure_id){
	$msgsock = Lexical::get_lexical_binding('_reph', 224, '$msgsock', isset($__closure_id)?$__closure_id:0);;
	socket_write($msgsock, $prompt_str, strlen($prompt_str));
		$msgsock = Lexical::get_lexical_binding('_reph', 224, '$msgsock', isset($__closure_id)?$__closure_id:0);;
	$code = socket_read($msgsock, 2048, PHP_NORMAL_READ);
	if(false__question($code)){
		return "quit";
	}
	else{
		return $code;
	}
}

function _reph__lambdafunc19($result, $__closure_id){
		$msgsock = Lexical::get_lexical_binding('_reph', 224, '$msgsock', isset($__closure_id)?$__closure_id:0);;
	$res_line = ($result . "\n");
	return socket_write($msgsock, $res_line, strlen($res_line));
}

function repl_loop($msgsock, $repl_vars){
	$__scope_id = Lexical::init_closure("_reph", 224);
	Lexical::bind_lexing("_reph", 224, '$msgsock', $msgsock);


	$prompt = new \PharenLambda("reph\\_reph__lambdafunc18", Lexical::get_closure_id("_reph", $__scope_id));
	Lexical::bind_lexing("_reph", 224, '$prompt', $prompt);


	$reph_prn = new \PharenLambda("reph\\_reph__lambdafunc19", Lexical::get_closure_id("_reph", $__scope_id));
	Lexical::bind_lexing("_reph", 224, '$reph_prn', $reph_prn);
		if(false__question(repl\work("", $repl_vars, $prompt, $reph_prn))){
		socket_shutdown($msgsock);
		return TRUE;
	}
	else{
		return NULL;
	}

}

function accept_loop($sock, $repl_vars){
	while(1){
		$msgsock = socket_accept($sock);
		$msg = repl\intro();
			socket_write($msgsock, $msg, strlen($msg));
			if(false__question(repl_loop($msgsock, $repl_vars))){
				return socket_close($sock);
			}
	}
}

function run($port=10000){
	global $argv;
	$addr = "127.0.0.1";
	$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	
	$__condtmpvar4 = Null;
	if(isset($argv[1])){
		$__condtmpvar4 = $argv[1];
	}
	else{
		$__condtmpvar4 = NULL;
	}
	$file = $__condtmpvar4;
	$repl_vars = get_repl_vars($file);
		if($file){
		compile_file($file);
	}
	else{
		NULL;
	}

		\NamespaceNode::$repling = TRUE;
	socket_bind($sock, $addr, $port);
	socket_listen($sock, 5);
	prn("Initializing Reph server on ", $addr, ":", $port);
	accept_loop($sock, $repl_vars);
	return socket_close($sock);
}

if(!(count(debug_backtrace()))){
	run();
}
else{
	NULL;
}


