<?php 
	include("includes/includedFiles.php");
?>
	<h1 class="pageHeadingBig">You Might Also Like</h1>
	<div class="gridViewContainer">
		<?php 
			$albumQuery = mysqli_query($con,"SELECT * FROM albums ORDER BY RAND() LIMIT 5");
			while($row = mysqli_fetch_array($albumQuery)){

				echo " 
				<div class='gridViewItem'>
					<span href='index.php'  role = 'link' tabindex = '0' onclick ='openPage(\"album.php?id=".$row['id']."\")' >
						<img src='". $row['artworkPath']. "' alt=''>

						<div class='gridViewInfo'>"
							.$row['title']."
						</div>
					</span>
				</div>";
			}
		?>
	</div>