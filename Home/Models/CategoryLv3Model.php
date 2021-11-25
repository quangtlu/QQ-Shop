<?php

class CategoryLv3Model extends BaseModel {
    const TABLE = 'category_lv3';

    public function getAll($select = ['*'],$orderBys = [''],$limit = 15){
        return $this->all(self::TABLE,$select,$orderBys,$limit);
    }
    public function getAllLimit($start,$number){
        return $this->all_limit(self::TABLE,$start,$number);
    }
    public function findById($id){
        return $this->find(self::TABLE,$id);
    }
    public function store($data){
        $this->create(self::TABLE,$data);
    }
    public function updateData($id,$data){
        $this->update(self::TABLE,$id,$data);
    }
    public function deleteData($id){
        $this->destroy(self::TABLE,$id);
    }
    public function findByCondition($col,$value){
        return $this->findBy(self::TABLE,$col,$value);
    }
    public function findAllByCondition($col,$value){
        return $this->findAllBy(self::TABLE,$col,$value);
    }
    public function findByTwoCondition($col1,$value1,$col2,$value2){
        return $this->finAllByTwo(self::TABLE,$col1,$value1,$col2,$value2);
    }
    public function checkExist($column,$value){
        return $this->isExist(self::TABLE,$column,$value);
    }

    public function getInfoUser($col,$value){
        return $this->findBy(self::TABLE,$col,$value);
    }
    public function checkExitsUpdate($column,$value,$id){
        return $this->isExistUpdate(self::TABLE,$column,$value,$id);
    }
    public function checkExitsUpdate2Value($column1,$value1,$column2,$value2,$id){
        return $this->isExistUpdate2Value(self::TABLE,$column1,$value1,$column2,$value2,$id);
    }
    public function getNumRecord(){
        return $this->count(self::TABLE);
    }
}