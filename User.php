<?php

/**
 * Created by VSCode.
 * User: luqman
 * Date: 10/06/17
 * Time: 9:35 PM
 */

class User{

    const STATE_INIT = 'init';
    const STATE_INIT_WEIGHT = 'init_weight';
    const STATE_INIT_HEIGHT = 'init_height';
    const STATE_INIT_GOAL = 'init_goal';
    const STATE_INIT_GENDER = 'init_gender';
    const STATE_LOGGING = 'logging';

    public $id,
        $user_id,
        $display_name,
        $line_id,
        $state,
        $current_weight,
        $starting_weight,
        $target_weight,
        $height,
        $mode,
        $gender;

    private $db;

    public function __construct(){
        $this->db = DB::getDB();
    }

    public function insert(){
        $sql = "INSERT INTO users (user_id, display_name,line_id, state) VALUES (:user_id, :display_name, :line_id, :state)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'user_id' => $this->user_id,
            'display_name' => $this->display_name,
            'line_id' => $this->line_id,
            'state' => self::STATE_INIT
        ]);
        $this->id = $this->db->lastInsertId();
        $this->state = self::STATE_INIT;
    }

    public static function exist($user_id){
        $statement = DB::getDB()->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $statement->execute(['user_id' => $user_id]);

        return $statement->rowCount() > 0;
    }

    public function save(){
        $sql = "UPDATE users SET state=:state, current_weight=:current_weight, starting_weight=:starting_weight, target_weight=:target_weight, height=:height, mode=:mode, gender=:gender WHERE id={$this->id}";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'state' => $this->state,
            'current_weight' => $this->current_weight,
            'starting_weight' => $this->starting_weight,
            'target_weight' => $this->target_weight,
            'height' => $this->height,
            'mode' => $this->mode,
            'gender' => $this->gender
        ]);
    }

    /**
     * @param $params
     * @return User
     */
    public static function findOne($params){
        $sql = "SELECT * FROM users";
        if(! empty($params)){
            $sql .= " WHERE";
            foreach (array_keys($params) as $key) {
                $sql .= " {$key} = :{$key} AND";
            }
            $sql = substr($sql, 0, -3);
        }
        $stmt = DB::getDB()->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchObject('User');

    }
}