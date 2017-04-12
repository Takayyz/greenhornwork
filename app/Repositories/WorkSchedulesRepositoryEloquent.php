<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\WorkSchedulesRepository;
use App\Entities\WorkSchedules;
use App\Validators\WorkSchedulesValidator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;

/**
 * Class WorkSchedulesRepositoryEloquent
 * @package namespace App\Repositories;
 */
class WorkSchedulesRepositoryEloquent extends BaseRepository implements WorkSchedulesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return WorkSchedules::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getAllSchedules()
    {
      $schedules = $this->model->orderBy('year', 'desc')
                               ->orderBy('month', 'desc')
                               ->get();
      return $schedules;
    }

    public function getOwnSchedules($userId)
    {
      $schedules = $this->model->where('user_id', $userId)
                                  ->orderBy('year', 'desc')
                                  ->orderBy('month', 'desc')
                                  ->get();
      return $schedules;
    }

    public function saveUploadFile($uploadFile, $userId)
    {
      //ファイルの拡張子取得
      $fileType = $uploadFile->getClientOriginalExtension();
      //ファイルパスを取得
      $filePath = 'schedules/' .$userId . '/' ;
      $fileFullPath = public_path() . '/' . $filePath;
      //ファイル格納先のフォルダが存在しなければ作成
      if (!file_exists($fileFullPath))  mkdir($fileFullPath);
      //ファイル名が重複しないように変更
      $fileName = $this->changeFileName($fileType);
      //ファイル保存
      $this->saveFile($fileType, $uploadFile, $fileName, $filePath);

      return [
        'filePath' => $filePath,
        'fileName' => $fileName,
        'fileType' => $fileType,
      ];
    }

    public function changeFileName($fileType)
     {
       $fileName = md5(uniqid(rand(), true)) . '.' .$fileType;
       return $fileName;
     }

     public function saveFile($fileType, $uploadFile, $fileName, $filePath)
     {
       if ($fileType === 'pdf')
       {
         //PDFの処理
         $uploadFile->move(public_path() . '/' . $filePath, $fileName);
       } else {
         //画像の処理
         $img = Image::make($uploadFile);
         $img->save($filePath. $fileName);
       }
     }

     public function createSchedule($userId, $filePath, $fileName, $fileType, $year, $month)
     {
       $this->model->create([
         'user_id' => $userId,
         'file_path' => $filePath,
         'file_name' => $fileName,
         'file_type' => $fileType,
         'year' => $year,
         'month' => $month,
       ]);
     }

     public function updateSchedule($fileName, $fileType, $year, $month, $id)
     {
       $this->model->where('id', $id)->update([
         'file_name' => $fileName,
         'file_type' => $fileType,
         'year' => $year,
         'month' => $month,
       ]);
     }

     public function updateOnlyDate($year, $month, $id)
     {
       $this->model->where('id', $id)->update([
         'year' => $year,
         'month' => $month,
       ]);
     }

     //アップロードされた勤務表と同年月の勤務表が既にDBに存在しないか確認
     public function checkDate($year, $month, $userId, $id = NULL)
     {
        $sameDate = DB::table('work_schedules')->where('year', $year)
                                               ->where('month', $month)
                                               ->where('user_id', $userId)
                                               ->where('id', '!=', $id )
                                               ->whereNull('deleted_at')
                                               ->count();
        if($sameDate === 0)
        {
          $errMsg = NULL;
        }else {
          $errMsg = $year .'年' . $month .'月'. 'の勤務表は既に保存されています。';
        }
        return $errMsg;
     }

     public function getSchedulesBySearch($input, $userId = NULL)
     {
       if($userId !== NULL) {
         $schedules = $this->model->DateRange($input)
                                  ->where('user_id', $userId)
                                  ->UserInfo($input)
                                  ->get();
       } else {
         $schedules = $this->model->DateRange($input)
                                  ->UserInfo($input)
                                  ->get();
       }

       return $schedules;
     }
}
