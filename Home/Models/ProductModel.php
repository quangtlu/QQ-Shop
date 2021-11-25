<?php

class ProductModel extends BaseModel {
    const TABLE = 'product';

    public function getAll($select = ['*'],$orderBys = [''],$limit = 15){
        return $this->all(self::TABLE,$select,$orderBys,$limit);
    }
    public function getAllLimit($start,$number,$orderByString=''){
        return $this->all_limit(self::TABLE,$start,$number,$orderByString);
    }
    public function searchAllLimit($start, $number, $col, $keyword)
    {
        return $this->search_limit(self::TABLE,$start,$number,$col, $keyword);

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
    public function checkExist($column,$value){
        return $this->isExist(self::TABLE,$column,$value);
    }

    public function getInfoUser($col,$value){
        return $this->findBy(self::TABLE,$col,$value);
    }
    public function checkExitsUpdate($column,$value,$id){
        return $this->isExistUpdate(self::TABLE,$column,$value,$id);
    }
    public function findAllByCondition($col,$value){
        return $this->findAllBy(self::TABLE,$col,$value);
    }
    public function findAllByConditionLimit($col,$value,$start,$number,$orderByString=''){
        return $this->findAllByLimit(self::TABLE,$col,$value,$start,$number,$orderByString);
    }
    public function getNumRecord(){
        return $this->count(self::TABLE);
    }
    // tính tổng tiền cho sản phẩm
    public function getSum($id,$price,$discount,$quantity){
        $sql = "SELECT $quantity*($price - ($price*($discount/100))) as total from product WHERE id = '$id'";
        $query = mysqli_query($this->connect(),$sql);
        return mysqli_fetch_assoc($query);
    }
}