<?php
// app/Enums/Role.php
namespace App\Enums;

use BenSampo\Enum\Enum;

final class Role extends Enum
{
    const Admin = 'admin';
    const Dosen = 'dosen';
    const HRD = 'hrd';
    const Kaprodi = 'kaprodi';
    const Reviewer = 'reviewer';
}

?>