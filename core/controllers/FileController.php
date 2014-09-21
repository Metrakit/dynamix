<?php

class FileController extends Controller 
{
	public function create ($path) {
		if (empty($path)) return false;
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

	public function renameDir ($new, $old) {
		if (empty($new) || empty($old)) return false;
		Log::info('CREATE : '.$new.' & : '.$old);
		return true;
		$files = Files::where('path','LIKE',$old.'*')->get();
		foreach ($files as $file) {
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