<?php

namespace Channel;

class Channel 
{
    protected $in;
    protected $out;
    protected $size;

    public function __construct($size=4096) {
        $this->size = $size;
        list($this->in, $this->out) = stream_socket_pair(
            STREAM_PF_UNIX,
            STREAM_SOCK_DGRAM,
            STREAM_IPPROTO_IP
        );
    }

    public function read() {
        return fread($this->in, $this->size);
    }

    public function write($data) {
        return fwrite($this->out, $data);
    }

}
