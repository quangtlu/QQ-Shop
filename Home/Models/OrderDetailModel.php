<?php

class OrderDetailModel extends BaseModel {
    const TABLE = 'order_details';

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
    public function findAllByConditionLimit($col,$value,$start,$number){
        return $this->findAllByLimit(self::TABLE,$col,$value,$start,$number);
    }
    public function getTotal($orderID){
        $sql = "SELECT od.order_id,SUM(od.quantity*(p.price - p.price*(p.discount/100))) as total  from order_details as od join product as p on od.product_id = p.id WHERE order_id=$orderID GROUP BY od.order_id";
        $query = mysqli_query($this->connect(),$sql);
        return mysqli_fetch_assoc($query);
    }
    public function getNumRecord(){
        return $this->count(self::TABLE);
    }
}