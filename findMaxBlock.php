<?php
class findMaxBlock {
    private $check;
    private $needFind; // 儲存欲搜尋的座標
    private $haveOne; // 儲存為1的座標
    private $shape;  // 儲存搜尋完成的區域
    
    public function checkShape($origin) {
        $this->check = $origin;
        
        foreach ($this->check as $y=>$column) {
            foreach ($column as $x=>$n) {
                $this->haveOne = array();
                $this->needFind = array();
                if ($this->check[$y][$x]==1) {
                    $this->haveOne[] = array($y,$x);
                    $this->find($y,$x); // 搜尋相鄰區域
                    $this->shape[] = $this->haveOne;  // 將搜尋結果儲存
                }
                
            }
            
        }
        
        $this->output($this->shape,$this->check);
        
    }
    
    private function output($shape,$check) {
        // 搜尋最大面積
        $big = 0;
        foreach ($shape as $value) {
            $big = (sizeof($value) > $big)? sizeof($value):$big;
        }
        
        // 顯示結果
        foreach ($shape as $value) {
            // 只顯示最大區域
            if (sizeof($value)!=$big)
                continue;
            
            // 將相應座標填上1
            $output = $check;
            foreach ($value as $xy) {
                $shapeY = $xy[0];
                $shapeX = $xy[1];
                $output[$shapeY][$shapeX] = 1;
            }
            
            // 輸出結果
            foreach ($output as $column) {
                foreach ($column as $n) {
                    echo $n;
                }
                echo "<br>";
            }
            
            echo "<hr>";
        }
    }
    
    private function find($y,$x) {
        $this->check[$y][$x] = 0 ; // 將找過的改為0
        
        // 加入要搜尋的右下左上的座標
        $this->needFind[] = array($y,$x+1); // 右
        $this->needFind[] = array($y+1,$x); // 下
        $this->needFind[] = array($y,$x-1); // 左
        $this->needFind[] = array($y-1,$x); // 上
        
        // 搜尋$needFind中的座標
        foreach ($this->needFind as $key=>$value) {
            $findY = $value[0];
            $findX = $value[1];
            
            unset($this->needFind[$key]); // 將找過的座標刪除
            if ($this->check[$findY][$findX]==1) {
                $this->haveOne[] = array($findY,$findX);
                $this->check[$y][$x] = 0 ; // 將找過的改為0
                $this->find($findY,$findX); // 搜尋該座標的相鄰區域
            }
            
        }
        
    }
    
}
    
?>