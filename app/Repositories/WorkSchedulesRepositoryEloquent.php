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

    //一覧表示（検索の場合は検索結果を表示）
    public function getSchedules($input = NULL, $userId = NULL)
    {
      $schedules = $this->model->WhereUserId($userId)
                               ->DateRange($input)
                               ->UserInfo($input)
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
      $filePath = sprintf($this->model->updateDir.'%s/',$userId);

      //ファイル格納先のフォルダが存在しなければ作成
      if (!file_exists($filePath))  mkdir($filePath, 0777, true);
      //ファイル名が重複しないように変更
      $fileName = $this->changeFileName($fileType);
      //ファイル保存
      $this->saveFile($fileType, $uploadFile, $fileName, $filePath);

      return [
        'file_path' => $filePath,
        'file_name' => $fileName,
        'file_type' => $fileType,
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
        $uploadFile->move(public_path() . $filePath, $fileName);
      } else {
        //画像の処理
        $img = Image::make($uploadFile);
        $img->save($filePath. $fileName);
      }
    }

    public function createSchedule($userId, $fileInfos, $year, $month)
    {
      $this->model->create([
      'user_id' => $userId,
        'file_path' => $fileInfos['file_path'],
        'file_name' => $fileInfos['file_name'],
        'file_type' => $fileInfos['file_type'],
        'year' => $year,
        'month' => $month,
      ]);
    }

    public function updateSchedule(array $fileInfos = NULL, $year, $month,$id)
    {
      if($fileInfos !== NULL) {
        $this->model->where('id', $id)->update([
          'file_name' => $fileInfos['file_name'],
          'file_type' => $fileInfos['file_type'],
          'year' => $year,
          'month' => $month,
        ]);
      } else {
        //ファイルがアップロードされなかった場合は日付のみ更新
        $this->model->where('id', $id)->update([
          'year' => $year,
          'month' => $month,
        ]);
      }
    }

     //アップロードされた勤務表と同年月の勤務表が既にDBに存在しないか確認
    public function checkDate($year, $month, $userId, $id = NULL)
    {
      $sameDate = $this->model->where('year', $year)
                                 ->where('month', $month)
                                 ->where('user_id', $userId)
                                 ->where('id', '!=', $id )
                                 ->count();
        if($sameDate === 0)
        {
          $errMsg = NULL;
        }else {
          $errMsg = $year .'年' . $month .'月'. 'の勤務表は既に保存されています。';
        }
        return $errMsg;
    }

}
