<?php
class findMaxBlock {
    private $check;
    private $needFind;
    private $haveOne;
    private $shape;
    
    public function checkShape($origin) {
        $this->check = $origin;
        
        foreach ($this->check as $y=>$column) {
            foreach ($column as $x=>$n) {
                $this->haveOne = array(); // 儲存為1的座標
                $this->needFind = array();
                if ($n==1) {
                    $this->haveOne[] = array($y,$x);
                    $this->find($y,$x); // 搜尋相鄰區域
                }
                
                if (sizeof($this->haveOne)>1) {
                    $this->shape[] = $this->haveOne; 
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
        
        // 將最大的相鄰區塊的座標填上1
        foreach ($shape as $value) {
            if (sizeof($value)!=$big)
                continue;
            
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
                $this->find($findY,$findX); // 搜尋該座標的相鄰區域
            }
            
        }
        
    }
    
}
    
?>