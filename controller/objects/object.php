<?php
    class Salon extends Database {

        public function get_one($table, $id) {
			$query = "SELECT * FROM `$table` WHERE `id` = $id";
			$rs = mysqli_query($this->get_connection(), $query);
			$row = mysqli_fetch_array($rs);
			return $row;
		}

        public function get_limit($table, $where, $start, $limit) {
            $query = "SELECT * FROM `$table` $where LIMIT $start, $limit";
			$result = mysqli_query($this->get_connection(), $query);
			return $result;
		}

        public function get_all($table, $where) {
            $query = "SELECT * FROM `$table` $where";
            $rs = mysqli_query($this->get_connection(), $query);
            return $rs;
        }

        public function pagination($table) {
			$query = mysqli_query($this->get_connection(), 'select count(id) as total from '.$table.'');
			$row = mysqli_fetch_assoc($query);
			$total_records = $row['total'];
			return $total_records;
		}

		public function insert($table, $value1, $value2) {
			$query = "INSERT INTO `$table`($value1) VALUES ($value2)";
			$rs = mysqli_query($this->get_connection(), $query);
            return $rs;
		}

		public function get_column($table) {
			$query = "SELECT `column_name`, `column_comment`, `column_type` FROM information_schema.columns WHERE table_name = '$table'";
			$rs = mysqli_query($this->get_connection(), $query);
            return $rs;
		}

		public function delete($table, $where) {
			$query = "DELETE FROM `$table` $where";
			$rs = mysqli_query($this->get_connection(), $query);
			return $rs;
		}

		public function update($table, $set, $where) {
			$query = "UPDATE `$table` SET $set WHERE $where";
			$rs = mysqli_query($this->get_connection(), $query);
			return $rs;
		}

		public function get_max_id($table) {
			$query = "SELECT MAX(id) FROM `$table`";
			$rs = mysqli_query($this->get_connection(), $query);
			return $rs;
		}

		public function code($code) {
			$query = "$code";
        	$rs = mysqli_query($this->get_connection(), $query);
			return $rs;
		}
    }
?>