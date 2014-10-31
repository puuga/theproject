<?php //system_description.php ?>
<?php include 'login_control.php'; ?>
<?php include 'db_connect.php'; ?>
<?php include "class_import.php"; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo String::system_title_full ?></title>

    <?php include 'head_tag.php'; ?>



  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <div class="container">
      <center><img src="image/banner3.png"></center>
    </div>

    <div class="jumbotron">
      <div class="container">
        <h1><center><?php echo String::system_title_full ?></center></h1>
      </div>
    </div>

    <div class="container">

      <div class="row">
        <div class="col-md-12">
          <div class="page-header">
            <h1>หลักการและเหตุผล</h1>
          </div>
          <p style="text-indent: 50px;">
            ปัจจุบันสื่อเทคโนโลยีสารสนเทศ ได้เข้ามามีบทบาทสําคัญต่อการจัดการเรียนการสอนเป็นอย่างมาก เนื่องจากเป็นสื่อที่ช่วยให้การจัดการเรียนการสอนมีประสิทธิภาพมากยิ่งขึ้น โดยที่ครอบคลุมวิธีการเรียนรู้หลาย รูปแบบ อาทิเช่น การเรียนรู้บนคอมพิวเตอร์ (Computer Based Learning) การเรียนรู้บนเว็บ (Web-Based Learning) และห้องเรียนเสมือนจริง (Virtual Classrooms) เป็นต้น โดยผู้เรียนสามารถเรียนรู้ผ่านสื่อเทคโนโลยี สารสนเทศได้ทุกประเภท เช่น อินเทอร์เน็ต (Internet) อินทราเน็ต (Intranet) เอ็กซ์ทราเน็ต (Extranet)
          </p>
          <p style="text-indent: 50px;">
            จากที่กล่าวมาข้างต้น การศึกษาผ่านสื่อเทคโนโลยีคอมพิวเตอร์ จึงเป็นสื่อที่มีความสําคัญมากสําหรับ การเรียนรู้ในปัจจุบัน และเติบโตแพร่หลายไปในทั่วโลก เพราะจุดเด่นของการเรียนการสอนผ่านสื่อเทคโนโลยี สารสนเทศ คือ สามารถเข้าถึงแหล่งข้อมูลและเนื้อหาวิชาความรู้ต่างๆ ได้อย่างสะดวกรวดเร็ว และเป็นการ แก้ปัญหาการขาดแคลนอาจารย์ที่มีความสามารถโดยทําให้ผู้เรียนสามารถเรียนกับอาจารย์เหล่านั้นได้ตลอดเวลา อีกทั้งสามารถเพิ่มโอกาสในการเรียนรู้ของผู้เรียนนอกห้องเรียนได้ และระบบการเรียนรู้กับคอมพิวเตอร์ที่ดีจะ สามารถช่วยให้ผู้เรียนพัฒนาทักษะไปได้รวดเร็วกว่าการเรียนในห้องเพียงอย่างเดียว
          </p>
          <p style="text-indent: 50px;">
            สํานักงานคณะกรรมการการศึกษาขั้นพื้นฐานต้องการส่งเสริมให้ครูและนักเรียนของโรงเรียนในสังกัด สํานักงานคณะกรรมการการศึกษาขั้นพื้นฐานมีทักษะการใช้สื่อเทคโนโลยีสารสนเทศ จัดการเรียนการสอน จึงได้ จัดทําโครงการพัฒนาคุณภาพครูและบุคลากรทางการศึกษาโดยใช้เทคโนโลยีสารสนเทศโรงเรียนในสังกัดสาํ นักงาน คณะกรรมการการศึกษาขั้นพ้ืนฐานเพื่อพัฒนาการเรียนการสอนในสถานศึกษาให้สอดคล้องกับบริบทของผู้เรียน สถานศึกษา และเขตพื้นที่การศึกษาตามความแตกต่างของสถานศึกษาในแต่ละภูมิภาค โดยจําแนกการพัฒนา ตามภูมิภาค ดังนี้ ภาคเหนือ ภาคตะวันออกเฉียงหนือตอนบน ภาคตะวันออกเฉียงหนือตอนล่าง ภาค กลาง ภาคตะวันออก ภาคใต้
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="page-header">
            <h1><?php echo String::system_objective ?></h1>
          </div>
          <ol>
            <li>
              เพื่อศึกษาหาความจําเป็นในการพัฒนา และจัดทําหลักสูตรในการพัฒนาผู้บริหารสํานักงานเขตพื้นที่ การศึกษา ผู้บริหารสถานศึกษา ศึกษานิเทศก์และครูผู้สอนให้มีความรู้ทักษะในการจัดการเรียนการสอนโดยใช้ สื่อเทคโนโลยีสารสนเทศ
            </li>
            <li>
              เพื่อดําเนินการพัฒนา ฝึกอบรมผู้บริหารสํานักงานเขตพื้นที่การศึกษา ผู้บริหารสถานศึกษา ศึกษานิเทศก์ และครูผู้สอนโดยการใช้สื่อเทคโนโลยีสารสนเทศในการเรียนการสอนตามกลุ่มสาระการเรียนรู้ให้สอดคล้องกับ บริบทของผู้เรียน สถานศึกษา และเขตพื้นที่การศึกษาตามความแตกต่างของสถานศึกษาในแต่ละภูมิภาค ดังนี้ ภาคเหนือ ภาคตะวันออกเฉียงเหนือตอนบน ภาคตะวันออกเฉียงเหนือตอนล่าง ภาคกลาง ภาคตะวันออก และ ภาคใต้
            </li>
          </ol>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="page-header">
            <h1><?php echo String::system_target ?></h1>
          </div>
          <h4>
            เชิงปริมาณ
          </h4>
          ฝึกอบรม พัฒนาผู้บริหาร ศึกษานิเทศก์และครูผู้สอนในสังกัดสํานักงานคณะกรรมการการศึกษาขั้น พื้นฐาน ในภาคเหนือจํานวน 51 เขต ประกอบด้วย
          <ol>
            <li>
              ผู้อํานวยการสํานักงานเขตพื้นที่การศึกษา จํานวน 51 คน
            </li>
            <li>
              รองผู้อํานวยการสํานักงานเขตพื้นที่การศึกษา จํานวน 51 คน
            </li>
            <li>
              ศึกษานิเทศก์ จํานวน 51 คน
            </li>
            <li>
              ผู้อํานวยการสถานศึกษา จํานวน 2,731 คน รวมประมาณ 2,884 คน
            </li>
            <li>
              ครู 8 กลุ่มสาระ ที่เป็นแกนนํา จํานวน 2,800 และที่ขยายผลจํานวน 17,572 คน รวมจํานวนทั้งหมดในภาคเหนือ 23,256 คน
            </li>
          </ol>

          <h4>
            เชิงคุณภาพ
          </h4>
          ฝึกอบรม พัฒนาผู้บริหาร ศึกษานิเทศก์และครูผู้สอนในสังกัดสํานักงานคณะกรรมการการศึกษาขั้น พื้นฐาน ในภาคเหนือจํานวน 51 เขต ประกอบด้วย
          <ul>
            <li>
              ผู้บริหาร ศึกษานิเทศก์ ครู มีความรู้ ความเข้าใจและทักษะการปฏิบัติการจัดการเรียนการสอนโดยใช้ เทคโนโลยีสารสนเทศ หรือคอมพิวเตอร์ในโรงเรียนสังกัดสํานักงานคณะกรรมการการศึกษาขั้นพื้นฐานสามารถ จัดการเรียนรู้ให้เหมาะสมกับบริบทนักเรียน สถานศึกษา แต่ละภูมิภาค
            </li>
            <li>
              มีองค์ความรู้การจัดการเรียนการสอนโดยใช้สื่อเพื่อการศึกษาแบบบูรณาการผ่านระบบเทคโนโลยี สารสนเทศ ภายใต้บริบททางการศึกษาของประเทศไทย สามารถนําไปขยายผลและพัฒนาต่อยอดได้ตามบริบท ของสถานศึกษาในแต่ละภูมิภาค
            </li>
          </ul>
        </div>
      </div>

    </div>

  </body>
</html>
