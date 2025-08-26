<?php 

/**
 * home class
 */
class Viewmore
{
	use Controller;

	public function index()
	{

		$this->view('agn/viewmore');
	}

    public function popup($id){
        $randrModel = new RandRModel();
        $Ruledata = $randrModel->where(['id' => $id]);
        $this->view('agn/viewmore', ['Ruledata' => $Ruledata]); // Pass data to the view

    }

}
