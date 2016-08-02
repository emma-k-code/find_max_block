# find_max_block
ver 3.0_20160802-[更改為class]<br>
1.在output.php中設定$orgin 並呼叫findMaxBlock(class)中的check方法<br>
2.使用foreach將陣列全部搜尋一遍 並把已搜尋過的都改為0<br>
3.當搜尋到1時 將其座標存入$haveOne 相鄰的座標存入$needFind中<br>
4.再使用foreach 搜尋$needFind中座標的相鄰座標 並將已搜尋的座標從$needFind中刪除<br>
5.重複2跟3直到$needFind中已沒有座標<br>
6.將$haveOne中所存區域存入$shape<br>
7.將陣列全部搜尋完之後 找出$shape中最大的區域 將其大小存為$big<br>
8.依$big的值 找出$shape 並將$output中與$shape相應的座標改為1<br>
9.用foreach輸出$output的內容<br>