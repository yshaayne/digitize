<?php
    echo $this->extend('layout/layout');
    echo $this->section('content');
    date_default_timezone_set('Asia/Hong_Kong');
    // $db = \Config\Database::connect();
    // $db_ticket = \Config\Database::connect("ticket");
    //====================================================================================
    ?>
        <h3 class="fw-bold fs-4 mb-3">ISUC DIGITAL FILES</h3>
        <div class="row">
            <div class="col-12 col-md-4 ">
                <div class="card border-0">
                    <div class="card-body py-4">
                        <h5 class="mb-2 fw-bold">
                            UPLOADS
                        </h5>
                        <p class="mb-2 fw-bold">
                            MIST
                        </p>
                        <div class="mb-0">
                            <span class="badge text-success me-2">
                                Last Update : 04-04-24
                                <?php echo strtotime("2024-04-03 17:00:00");?><br>
                            </span>
                            <span class=" fw-bold">
                                100 total files
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 ">
                <div class="card  border-0">
                    <div class="card-body py-4">
                        <h5 class="mb-2 fw-bold">
                           DOWNLOADS
                        </h5>
                        <p class="mb-2 fw-bold">
                            HR
                        </p>
                        <div class="mb-0">
                            <span class="badge text-success me-2">
                                Last Update : 04-04-24
                            </span>
                            <span class=" fw-bold">
                                100 total files
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 ">
                <div class="card border-0">
                    <div class="card-body py-4">
                        <h5 class="mb-2 fw-bold">
                            DL/UL
                        </h5>
                        <p class="mb-2 fw-bold">
                            ALL
                        </p>
                        <div class="mb-0">
                            <span class="badge text-success me-2">
                                Last Update : 04-04-24
                            </span>
                            <span class=" fw-bold">
                                400 total files
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="fw-bold fs-4 my-3">ACCOUNTS
        </h3>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr class="highlight">
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col"># files uploaded</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Juan</td>
                            <td>Dela Cruz</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>wan</td>
                            <td>tu</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2">maria</td>
                            <td>30</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php
    //====================================================================================
    
    echo $this->endSection();
    echo $this->section('index-script');
    ?>
        
    <?php
    echo $this->endSection();
?>