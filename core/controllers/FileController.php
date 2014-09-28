<?php

class FileController extends Controller 
{
	public function create ($path) {
		if (empty($path)  || strpos($path, 'uploads_thumbs')) return false;
		Log::info('CREATE : '.$path);
		$file = new Files();
		$file->path = $path;
		$file->type_id = 1;
		if (empty($file->save())) return false;
		return true;
	}


	public function renameFile ($new, $old) {
		if (empty($new) || empty($old)) return false;
		Log::info('CREATE : '.$new.' & : '.$old);
		return true;
		$file = Files::where('path','LIKE',$old.'*')->first();
		$file->path = $new . substr($file->path, strlen($old), strlen($file->path) - strlen($old));
		if ($file->save()) {
			return true;
		} else {
			return flase;
		}
	}

	public function renameDir ($old, $new) {
		if (empty($new) || empty($old) || strpos($old, 'uploads_thumbs')) return false;
		Log::info('RENAME-DIR : '.$old.' TO : '.$new);
		$files = Files::where('path','LIKE',$old.'%')->get();
		Log::info(count($files));
		foreach ($files as $file) {
			Log::info('old : '.$file->path);
			Log::info('strlen($file->path) : '.strlen($file->path));
			Log::info('strlen($old) : '.strlen($old));
			Log::info('new : ' . substr($file->path, strlen($old), strlen($file->path) - strlen($old) ) );
			
			$file->path = $new . substr($file->path, strlen($old), strlen($file->path) - strlen($old));
			if ($file->save()) {
				continue;
			} else {
				return flase;
			}
		}
		return true;
	}

	public function delete ($path) {
		if (empty($path)) return false;
		Log::info('DELETE : '.$path);
		$file = Files::where('path','=',$path)->first();
		if (empty($file)) return false;
		if ($file->delete()) return true;
		return false;
	}
}