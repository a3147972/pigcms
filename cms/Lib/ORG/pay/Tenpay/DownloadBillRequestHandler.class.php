<?php

class DownloadBillRequestHandler extends RequestHandler
{
    public function WapResponseHandler()
    {
        parent::ResponseHandler();
    }

    public function createSign()
    {
        $signPars = "";
        $signPars = $signPars . "spid=" . $this->getParameter("spid") . "&trans_time=" . $this->getParameter("trans_time") . "&stamp=" . $this->getParameter("stamp") . "&cft_signtype=" . $this->getParameter("cft_signtype") . "&mchtype=" . $this->getParameter("mchtype") . "&key=" . $this->getKey();
        $sign = strtolower(md5($signPars));
        $this->setParameter("sign", $sign);
        $this->_setDebugInfo($signPars . " => sign:" . $sign);
    }
}


?>
