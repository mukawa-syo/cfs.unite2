<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // 外部キー制約を削除
            $table->dropForeign(['reward_detail_id']);
            // カラムを削除
            $table->dropColumn('reward_detail_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // カラムを再追加
            $table->unsignedInteger('reward_detail_id')->nullable();
            // 外部キー制約を再追加
            $table->foreign('reward_detail_id')
                  ->references('reward_detail_id')
                  ->on('reward_details')
                  ->onDelete('set null');
        });
    }
};

            // 外部キー制約を再追加
            $table->foreign('reward_detail_id')
                  ->references('reward_detail_id')
                  ->on('reward_details')
                  ->onDelete('set null');
        });
    }
};

            // 外部キー制約を再追加
            $table->foreign('reward_detail_id')
                  ->references('reward_detail_id')
                  ->on('reward_details')
                  ->onDelete('set null');
        });
    }
};

            // 外部キー制約を再追加
            $table->foreign('reward_detail_id')
                  ->references('reward_detail_id')
                  ->on('reward_details')
                  ->onDelete('set null');
        });
    }
};

            // 外部キー制約を再追加
            $table->foreign('reward_detail_id')
                  ->references('reward_detail_id')
                  ->on('reward_details')
                  ->onDelete('set null');
        });
    }
};

            // 外部キー制約を再追加
            $table->foreign('reward_detail_id')
                  ->references('reward_detail_id')
                  ->on('reward_details')
                  ->onDelete('set null');
        });
    }
};
