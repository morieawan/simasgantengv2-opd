<?php

namespace app\modules\simpeg\models;

use Yii;

/**
 * This is the model class for table "eps_mastfip".
 *
 * @property string $A_00
 * @property string $A_01
 * @property string $A_02
 * @property string $A_03
 * @property string $A_04
 * @property string $B_01
 * @property string $B_02
 * @property string $B_03A
 * @property string $B_03
 * @property string $B_03B
 * @property string $B_04
 * @property string $B_05
 * @property int $B_06
 * @property int $B_07
 * @property int $B_08
 * @property int $B_09
 * @property int $B_10
 * @property string $B_11
 * @property string $B_12
 * @property string $B_13
 * @property int $B_14
 * @property string $B_15
 * @property string $B_16
 * @property int $B_17
 * @property string $C_00
 * @property string $C_01
 * @property string $C_02
 * @property string $C_03
 * @property int $C_04
 * @property string $D_00
 * @property string $D_01
 * @property string $D_02
 * @property int $D_03
 * @property string $D_04
 * @property int $D_05
 * @property string $E_01
 * @property string $E_02
 * @property string $E_03
 * @property int $E_04
 * @property string $E_05
 * @property string $E_06
 * @property string $E_07
 * @property string $F_01
 * @property string $F_02
 * @property string $F_02A
 * @property int $F_03
 * @property string $F_04
 * @property string $F_05
 * @property string $F_06
 * @property int $F_07
 * @property string $G_01
 * @property string $G_02
 * @property string $G_03
 * @property string $G_04
 * @property string $G_05
 * @property int $G_05A
 * @property string $G_05B
 * @property int $G_06
 * @property string $G_07
 * @property string $G_08
 * @property string $G_09
 * @property string $G_10
 * @property string $G_11
 * @property string $G_11A
 * @property int $H_01
 * @property string $H_02
 * @property int $H_03
 * @property int $I_01
 * @property string $I_02
 * @property int $I_03
 * @property string $J_01
 * @property string $J_02
 * @property string $J_03
 * @property string $J_04
 * @property string $J_05
 * @property string $J_06
 * @property string $J_07
 * @property string $J_08
 * @property string $K_01
 * @property string $K_02
 * @property string $K_03
 * @property string $K_04
 * @property int $K_05
 * @property int $K_06
 * @property string $K_07
 * @property int $L_01
 * @property int $L_02
 * @property string $M_01
 * @property string $M_02
 * @property string $M_03
 * @property int $M_04
 * @property string $M_05
 * @property string $M_06
 * @property string $M_07
 * @property int $Z_99
 * @property string $no_telp
 * @property string $foto
 * @property string|null $nik
 * @property string|null $updated
 */
class SimpegEpsMastfip extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eps_mastfip';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db3');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['B_02', 'B_17', 'E_07', 'F_04', 'F_05', 'F_06', 'F_07', 'G_07', 'G_08', 'G_09', 'G_10', 'G_11', 'G_11A', 'M_01', 'M_02', 'M_03', 'M_04', 'M_05', 'M_07', 'foto'], 'required'],
            [['B_05', 'C_01', 'C_03', 'D_02', 'D_04', 'E_03', 'E_05', 'F_01', 'F_06', 'G_03', 'G_04', 'G_09', 'G_10', 'I_02', 'J_03', 'J_07', 'K_03', 'K_04', 'M_03', 'M_05', 'updated'], 'safe'],
            [['B_06', 'B_07', 'B_08', 'B_09', 'B_10', 'B_14', 'B_17', 'C_04', 'D_03', 'D_05', 'E_04', 'F_03', 'F_07', 'G_05A', 'G_06', 'H_01', 'H_03', 'I_01', 'I_03', 'K_05', 'K_06', 'L_01', 'L_02', 'M_04', 'Z_99'], 'integer'],
            [['A_00', 'A_01', 'A_02', 'A_03', 'A_04', 'B_01', 'F_02', 'F_02A'], 'string', 'max' => 2],
            [['B_02', 'K_07'], 'string', 'max' => 18],
            [['B_03A'], 'string', 'max' => 10],
            [['B_03', 'foto'], 'string', 'max' => 50],
            [['B_03B'], 'string', 'max' => 15],
            [['B_04', 'B_11', 'B_12', 'B_13', 'B_15', 'B_16', 'C_00', 'D_00', 'E_01', 'E_07', 'F_04', 'G_01', 'G_05B', 'J_04', 'J_08', 'no_telp'], 'string', 'max' => 255],
            [['C_02', 'G_02', 'G_08', 'G_11A', 'J_02', 'J_06', 'K_02', 'M_01', 'M_02', 'M_07'], 'string', 'max' => 100],
            [['D_01', 'E_02', 'F_05', 'J_01', 'J_05', 'K_01'], 'string', 'max' => 150],
            [['E_06', 'G_11', 'M_06'], 'string', 'max' => 4],
            [['G_05'], 'string', 'max' => 8],
            [['G_07'], 'string', 'max' => 3],
            [['H_02'], 'string', 'max' => 6],
            [['nik'], 'string', 'max' => 20],
            [['B_02'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'A_00' => 'A 00',
            'A_01' => 'A 01',
            'A_02' => 'A 02',
            'A_03' => 'A 03',
            'A_04' => 'A 04',
            'B_01' => 'B 01',
            'B_02' => 'B 02',
            'B_03A' => 'B 03a',
            'B_03' => 'B 03',
            'B_03B' => 'B 03b',
            'B_04' => 'B 04',
            'B_05' => 'B 05',
            'B_06' => 'B 06',
            'B_07' => 'B 07',
            'B_08' => 'B 08',
            'B_09' => 'B 09',
            'B_10' => 'B 10',
            'B_11' => 'B 11',
            'B_12' => 'B 12',
            'B_13' => 'B 13',
            'B_14' => 'B 14',
            'B_15' => 'B 15',
            'B_16' => 'B 16',
            'B_17' => 'B 17',
            'C_00' => 'C 00',
            'C_01' => 'C 01',
            'C_02' => 'C 02',
            'C_03' => 'C 03',
            'C_04' => 'C 04',
            'D_00' => 'D 00',
            'D_01' => 'D 01',
            'D_02' => 'D 02',
            'D_03' => 'D 03',
            'D_04' => 'D 04',
            'D_05' => 'D 05',
            'E_01' => 'E 01',
            'E_02' => 'E 02',
            'E_03' => 'E 03',
            'E_04' => 'E 04',
            'E_05' => 'E 05',
            'E_06' => 'E 06',
            'E_07' => 'E 07',
            'F_01' => 'F 01',
            'F_02' => 'F 02',
            'F_02A' => 'F 02a',
            'F_03' => 'F 03',
            'F_04' => 'F 04',
            'F_05' => 'F 05',
            'F_06' => 'F 06',
            'F_07' => 'F 07',
            'G_01' => 'G 01',
            'G_02' => 'G 02',
            'G_03' => 'G 03',
            'G_04' => 'G 04',
            'G_05' => 'G 05',
            'G_05A' => 'G 05a',
            'G_05B' => 'G 05b',
            'G_06' => 'G 06',
            'G_07' => 'G 07',
            'G_08' => 'G 08',
            'G_09' => 'G 09',
            'G_10' => 'G 10',
            'G_11' => 'G 11',
            'G_11A' => 'G 11a',
            'H_01' => 'H 01',
            'H_02' => 'H 02',
            'H_03' => 'H 03',
            'I_01' => 'I 01',
            'I_02' => 'I 02',
            'I_03' => 'I 03',
            'J_01' => 'J 01',
            'J_02' => 'J 02',
            'J_03' => 'J 03',
            'J_04' => 'J 04',
            'J_05' => 'J 05',
            'J_06' => 'J 06',
            'J_07' => 'J 07',
            'J_08' => 'J 08',
            'K_01' => 'K 01',
            'K_02' => 'K 02',
            'K_03' => 'K 03',
            'K_04' => 'K 04',
            'K_05' => 'K 05',
            'K_06' => 'K 06',
            'K_07' => 'K 07',
            'L_01' => 'L 01',
            'L_02' => 'L 02',
            'M_01' => 'M 01',
            'M_02' => 'M 02',
            'M_03' => 'M 03',
            'M_04' => 'M 04',
            'M_05' => 'M 05',
            'M_06' => 'M 06',
            'M_07' => 'M 07',
            'Z_99' => 'Z 99',
            'no_telp' => 'No Telp',
            'foto' => 'Foto',
            'nik' => 'Nik',
            'updated' => 'Updated',
        ];
    }
}
