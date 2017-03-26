<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\WorkSchedulesRepository;
use App\Entities\WorkSchedules;
use App\Validators\WorkSchedulesValidator;
use Intervention\Image\ImageManagerStatic as Image;

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

    public function changeFileName($fileType)
     {
       $fileName = md5(uniqid(rand(), true)) . '.' .$fileType;
       return $fileName;
     }

     public function imgSave($uploadFile, $fileType, $fileName)
     {
       //保存するファイルを取得
       $img = Image::make($uploadFile);
       //ファイル保存
       $img->save('schedules/'. $fileName);

       return $fileName;
     }

     public function pdfSave($uploadFile, $fileType, $fileName)
     {
       //保存先ファイルパス取得
       $filePath = public_path() . '/schedules/';
       //ファイル保存
       move_uploaded_file($uploadFile, $filePath . $fileName);

       return $fileName;
     }
}
