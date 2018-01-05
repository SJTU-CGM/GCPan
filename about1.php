<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>About</title>
	<?php include 'include/libs.php' ?>
	<link rel="stylesheet" href="css/bootstrap-responsive.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/about.css">
	<script>
		function goTop()
		{
		    $(window).scroll(function(e) {
		        if($(window).scrollTop()>100)
		            $("#gotop").fadeIn(100);//0.1 second to display go top
		        else
		            $("#gotop").fadeOut(100);//0.1 second to hide go top
		    });
		};
		$(function(){
		    //back to top
		    $("#gotop").click(function(e) {
		            //1 second to go top
		            $('body,html').animate({scrollTop:0},100);
		    });
		    $("#gotop").mouseover(function(e) {
		        $(this).css("background","url(pic/backtop.png) no-repeat 0px 0px");
		    });
		    $("#gotop").mouseout(function(e) {
		        $(this).css("background","url(pic/backtop.png) no-repeat -70px 0px");
		    });
		    goTop();//display and hide
		});
	</script>
</head>
<body>
<?php include 'include/header.php' ?>
<div id="gotop"></div>
<div class="container">

<div class="span2 bs-docs-sidebar page-sidebar" id="sidebar">
	<ul class="nav nav-list bs-docs-sidenav affix-top">
		<li><a href="#about">About</a></li>
        <!-- <li><a href="#cite">Citing RPAN</a></li> -->
		<li><a href="#tutorial">Manual</a>
            <!-- <ul class="sub-menu"><a href="#intro">Introduction</a></ul> -->
            <!-- <ul class="sub-menu"><a href="#term">Terminology</a></ul> -->
            <!-- <ul class="sub-menu"><a href="#bsearch">Basic Search</a></ul> -->
            <!-- <ul class="sub-menu"><a href="#asearch">Advanced Search</a></ul> -->
			<ul class="sub-menu"><a href="#table">Table Browser</a></ul>
			<!-- <ul class="sub-menu"><a href="#visualization">Visualization</a></ul> -->
			<!-- <ul class="sub-menu"><a href="#download">Download</a></ul> -->
		</li>
		<li><a href="#update">Update logs</a></li>
	</ul>
</div>
<div class="span9" style="float:right">
<div class="page-region-content">
<section id="about">
<div class="page-header">
   <h1>About Gastric Carcinoma Pan-genome</h1>
</div>
	
	<!-- <p>
		Pan-genome analysis were carried out for the 3,010 rice accessions. First, we built a comprehensive dataset of rice sequences by combining IRGSP reference and <i>de novo</i> assembled contigs from 3,010 deep sequencing rice genomes. It showed rice as a species contains almost as twice genome sequence contents as an individual rice genome. 15,362 genes were predicted on these sequences. The presence/absence variation of each gene was detected for 453 rice accessions with sequencing coverage higher than 20. Phylogenetic study based on these variation was carried out. All rice were grouped based on the phylogenetic study and between-group variations were further studied. The distributed genes not included in the reference genome have important functions, such as those response to freezing and cold acclimation. The pan-genome analysis of the 3K rice genomes revealed the variation among different rice accessions. 
	</p> -->
</section>

<!-- <section>
    <div class="page-header">
        <h1>Citing RPAN</h1>
    </div>
    <p>If you use RPAN in a project that you publish, please cite the most recent RPAN paper, which is <a href="https://academic.oup.com/nar/article/45/2/597/2333876/RPAN-rice-pan-genome-browser-for-3000-rice-genomes">here in Nucleic Acids Research</a>.</p>
</section> -->

<section id="tutorial">
<div class="page-header">
	<h1>User Manual</h1>
</div>
    <section id="intro">
    	<!-- <h2>Introduction</h2> -->
        <!-- <p>The cultivated rice, <i>Oryza sativa</i> L., is one of the major staple food for the world and a model organism in plant biology. The 3,000(3K) Rice Genome Project gives us an opportunity to gain insight into the genome diversity within the <i>O</i>. sativa gene pool. Comprehensive analyses of 3,010 rice genomes revealed the population organization of the genome variation in the rice pan-genome. RPAN presents analysis results from 3K rice genome data, focusing on gene presence/absence variation (PAV), which provides new perspective for rice researchers and breeding experts.</p> -->

    	<!-- <p>RPAN includes the following data:</p> -->
    	<!-- <ol>
    		<li><b>Basic information of the 3,010 rice accessions</b>, including accession names, sequencing depths, mapping depths on the IRGSP-1.0 genome and meta-information such as geological locations, subspecies (or subgroups) categorizations, etc.</li>
    		<li><b>Sequences and gene annotations for the rice pan-genome</b>, including a total of 50,995 full-length coding genes and protein coding sequences and protein sequences of all these genes.</li>
    		<li><b>Gene presence/absence variations (PAVs)</b>. The presence/absence of genes in the rice pan-genome were determined by 453 high-quality accessions. All genes were then categorized as core, candidate core or different types of distributed genes. In total, there are 23,914 core genes, 4,986 candidate core genes and 22,095 distributed genes. Of the distributed genes, 853 genes are subspecies or varietal group specific, including 587, 147, 67 and 52 genes for Indica and Japonica subspecies, Aus and Aro groups, respectively.</li>
    		<li><b>Genome-wide expression profiles for the rice pan-genome</b>, including expression data from 226 publicly available RNA-seq runs.</li>
    	</ol> -->
    	<!-- <p>RPAN also provides the following analysis tools:</p> -->
    	<!-- <ol>
    		<li>Basic search functions:</li>
    		<ul>
    			<li>Search a <b>single gene</b> (with its gene ID) to obtain its basic information, distributions, PAVs and gene functions.</li>
    			<li>Search a <b>single rice accession</b> (with its accession code) to obtain its sequencing landscape and meta-information (geological location, subspecies categorization, etc). </li>
    			<li>Search nucleotide <b>sequence(s)</b> against the rice pan-genome. A BLAT search server with the rice pan-genome as the reference sequence was deployed in RPAN. A sequence or multiple sequences in FASTA format can be searched. All hit regions in the rice pan-genome will be returned and can be visualized in the genome browser.</li>
    		</ul>
    		<li>Advanced search functions:</li>
    		<ul>
    			<li>Search <b>multiple rice accessions</b> to obtain their shared genes.</li>
    			<li>Search <b>multiple genes</b> to obtain rice accessions in which they are all present.</li>
    		</ul>
    		<li>Visualization  functions:</li>
    		<ul>
    			<li><b>A tree browser</b> visualizes the phylogeny of the 3,010 rice accessions. It also allows users to select the tracks which can then be visualized directly in the genome browser. The phylogenetic tree was constructed based on SNPs.</li>
    			<li><b>The genome browser</b> was built based on JBrowse to visualize genome sequences, gene annotations, gene expressions, and presence-absence variations (PAVs). Users can search accession ID or any text related to the tracks information in tracks selection panel. Searched results can be saved as a custom track for a subsequent comparison.</li>
    		</ul>
    	</ol> -->
	</section>

    <section id="term">
        <!-- <div class="page-header">
           <h2>Terminology</h2>
        </div> -->
        <!-- <h3 id=ref>The reference pan-genome</h3>
        <p>The reference pan-genome was constructed on the IRGSP genome and the non-redundant unaligned contigs. All these contigs were grouped into 12 groups according to the classification of their corresponding rice accessions. These groups include four subgroups (IG1, IG2, IG3, IG4, IG5) of subspecies Indica, AUSG6, four subgroups (JG7, JG8, JG9, JG10) of subspecies Japonica, AROG11 and admixtures (Adm). The contigs from the same group were concatenated with 100 consecutive Ns as delimiters. Finally, the IRGSP genome and these pseudo-chromosomes were merged as the reference pan-genome. All the contents in RPAN are based on this reference.</p>

        <h3>High quality Accessions</h3>
        <p>453 high quality genomes with sequencing depths >20x and mapping depths >15x were chosen for detailed Pan-genome analyses.</p>
        
        <p>To get the list of high quality accessions, visit <a href="rice-table.php" target="_blank">rice table</a> page and check "Yes" in the "High quality accessions" option.</p>
        
        <img src="pic/high-quality.svg" alt="">
        <p>Figure 1. High quality accession criterion.</p>

        <h3 id="geneCate">Gene Categorization</h3>
        <table class="table table-striped table-hover table-bordered">
        <p>All genes were categorized according to their presence/absence in the 453 high-quality accessions. </p>
        <tr>
            <td>Core genes</td>
            <td>Genes which exist in all high-quality rice accessions</td>
        </tr>
        <tr>
            <td>Distributed genes</td>
            <td>Genes which exist in significantly less than 99% of accessions (binomial tests, p-value < 0.05, null hypothesis is “loss rate < 1%”) </td>
        </tr>
        <tr>
            <td>Candidate Core genes</td>
            <td>Genes which exist in > 99% (not all) of high-quality rice accessions (binomial test, fdr < 0.05)</td>
        </tr> 
        <tr>
            <td style="width:35%">Subspecies-unbalanced genes</td>
            <td style="width:65%">Distributed genes whose frequency in one or more subspecies is significantly higher than that in other subspecies (Fisher's test, FDR < 0.05)</td>
        </tr>
        <tr>
            <td style="text-indent:25px"><i>Indica</i>-dominant genes</td>
            <td>Subspecies-unbalanced genes whose frequencies in <i>Indica</i> is 5% greater than their frequencies in <i>Japonica</i></td>
        </tr>
        <tr>
            <td style="text-indent:25px"><i>Japonica</i>-dominant genes</td>
            <td>Subspecies-unbalanced genes whose frequencies in <i>Japonica</i> is 5% greater than their frequencies in <i>Indica</i></td>
        </tr>
        <tr>
            <td>Subspecies-specific genes</td>
            <td> Distributed genes which exist in a subspecies but absent in all other subspecies</td>
        </tr>
        <tr>
            <td style="text-indent:25px"><i>Indica</i>-specific genes</td>
            <td>genes only exist in <i>Indica</i></td>
        </tr>
        <tr>
            <td style="text-indent:25px"><i>Japonica</i>-specific genes</td>
            <td>genes only exist in <i>Japonica</i></td>
        </tr>
        <tr>
            <td style="text-indent:25px">AUS-specific genes</td>
            <td>genes only exist in AUS</td>
        </tr>
        <tr>
            <td style="text-indent:25px">ARO-specific genes</td>
            <td>genes only exist in ARO</td>
        </tr>
        <tr>
            <td>Subgroup-unbalanced genes</td>
            <td>Distributed genes whose frequency in one or more sub-groups of a subspecies is significantly higher than the frequencies in other sub-groups in this subspecies. </td>
        </tr>
        <tr>
            <td style="text-indent:25px"><i>Indica</i>-subgroup-unbalanced genes</td>
            <td>Distributed genes which are abundant (or have significantly higer frequencies) in specific <i>Indica</i> subgroup(s) but have low frequencies in the other <i>Indica</i> subgroup(s) (Fisher's test, FDR < 0.05)</td>
        </tr>
        <tr>
            <td style="text-indent:25px"><i>Japonica</i>-subgroup-unbalanced genes</td>
            <td>Distributed genes which are abundant (or have significantly higer frequencies) in specific <i>Japonica</i> subgroup(s) but have low frequencies in the other <i>Japonica</i> subgroup(s) (Fisher's test, FDR < 0.05)</td>
        </tr>
        <tr>
            <td>Random genes</td>
            <td>Distributed genes which show no difference among gorups and sub-groups (genes are not core, candidate core, subspecies unbalanced and sub-group unbalanced)</td>
        </tr>
        </table>

        <h3 id="tree">Phylogenetic tree</h3>
        <p>The phylogenetic tree was constructed based on PAVs among 453 high quality accessions.</p>
        <p>Through the gene distribution tree of single gene search result, users could find the presence of this gene on phylogenetic tree directly. Users could also compare this tree with the tree with classification and geographical distribution labeled below.</p>
        <img src="pic/geoTree.svg" alt="tree">
        <p>Figure 2. Phylogenetic tree of 453 high quality accessions.</p>

        <h3 id="gene_age">Gene Age</h3>
        <img src="pic/geneAge.png" alt="Gene Age" style="height:600px">
        <p>Figure 3. Gene Age.</p>
        <p>Summary of estimated ages of all genes of the <i>O. sativa</i> pan genomes. The numbers of genes emerged at different evolutionary times starting from PS1 (single cell organisms) to PS13 (<i>Oryza sativa</i>)  were listed in the Figure 3.</p> -->
    </section>

    <section id="bsearch">
        <!-- <h2>Basic Search</h2> -->

        <!-- <h3>Search by a gene ID</h3>
        <p>Users can type a gene ID (e.g. Os02g0561500) in the search box. After clicking the “Search” button, a new page will display search results. The results consist of seven parts: basic gene information, gene categorization, gene distribution, gene presence frequency, gene ontology, CDS and protein sequence.</p>
        <img src="pic/manualPics/onegeneid.PNG" style="width:500px">
        <p>Figure 4. Example of search by a gene ID.</p>
        <p>Basic gene information includes:</p>
        <ul>
            <li>ID: database ID</li>
            <li>source: IRGSP or maker</li>
            <li>chrom: chromosome number</li>
            <li>start: start coordinate in the chromosome</li>
            <li>end: end coordinate in the chromosome</li>
            <li>CDS length: the length of coding DNA sequence</li>
            <li>exon number: the number of exons</li>
            <li>gene ID: the accession number in RAP-DB</li>
            <li>visualization: to visualize this gene in genome browser</li>
        </ul>
        <p>Gene categorization</p>
            <ul><li>See <a href="#geneCate">terminology</a>.</li></ul>
        <p>Gene presence frequency</p>
            <ul><li>The first heatmap indicates the presence frequency in subspecies of this gene.</li></ul>
            <ul><li>The second heatmap indicates the presence frequency in subgroups of this gene.</li></ul>
        <p>Gene ontology</p>
            <ul><li>GO term ID and name of this gene. Users can click the ID to get detailed information.</li></ul>
        <p>CDS</p>
            <ul><li>Coding DNA sequence in FASTA format.</li></ul>
        <p>Protein sequence</p>
            <ul><li>Protein sequence in FASTA format.</li></ul>
        </ul>

        <h3>Search by DNA sequence</h3>
        <p>Users can also search with genomic sequences against the rice pan-genome directly. One or more sequences in the FASTA format can be searched. All alignments can be further checked in a detailed page by clicking the "Genome Browser" button in the record line and visualized in the pan-genome browser.</p>
        <img src="pic/manualPics/searchSeq.PNG" alt="" style="height:600px">
        <img src="pic/manualPics/blat.PNG" alt="" style="width: 800px">
        <p>Figure 5. Example of search by DNA sequences.</p>

        <h3>Search by one rice accession</h3>
        <p>Users can type an accession code (e.g. B001) into the search box. After clicking the “Search” button, a new page will display search results. The results consist of three parts: basic rice accession information and statistics of genes’ categorizations in this rice accession.</p>
        <img src="pic/manualPics/onericecode.PNG" alt="" style="width:500px">
        <p>Figure 6. Example of search by a rice accession.</p>
        <p>Basic rice information includes:</p>
        <ul>
            <li>ID: accession ID in RPAN</li>
            <li>code: code of accession</li>
            <li>name: variety name</li>
            <li>meta-information-based subspecies: subspecies categorization by meta information, including JAP(japonica), IND(indica), AUS(aus/boro), ADM(admixed), ARO(aromatic basmati/sadri), TROP(tropical japonica) and TEMP(temperate japonicas)</li>
            <li>SNP-based subspecies: subspecies categorization by SNP analysis: including JAP, IND, AUS, ARO and ADM</li>
            <li>SNP-based subgroup: subgroup categorization by SNP analysis: including IG1, IG2, IG3, IG4, IG5, AUSG6, JG7, JG8, JG9, JG10, AROG11 and Adm</li>
            <li>country: source country of the accession</li>
            <li>region: region of the rice accession, including AFR(Africa), AME(America), EAS(East Asia), EUR(Europe), OCE(Oceania), SAS(South Asia), SEA(Southeast Asia), WAS(West Asia), WEU(West Europe), NA(not available)</li>
            <li>sequencing depth</li>
            <li>mapping depth:  the value of the total size of mapped reads divided by the length of IRGSP 1.0 genome</li>
            <li>mapping coverage: the percentage of the IRGSP 1.0 reference genome covered by mapped reads</li>
        </ul>
        <p>Gene statistics</p>
        <ul>
            <li>The table summarizes the numbers of genes in different categorizations.</li>
            <li>The three pie charts show the percentage of gene categorizations at different levels, including core/distributed, specific and unbalanced..</li>
        </ul> -->
    </section>

    <section id="asearch">
        <!-- <h2>Advanced Search</h2> -->

        <!-- <h3 id="multirice">Search by rice list to obtain their shared genes</h3>
        <p>Users can input multiple accession codes in the search box or upload a file containing accession codes. The least number of rice accessions sharing a specific gene can be an optional parameter. If this number is set to 1, the search result will be all genes existing in all the input accessions; similarly, if the number is set to the number of all input accessions, the core genes of all input accessions would be acquired. Then, the basic information of these accessions and the resulted genes could be downloaded and the statistics tables and charts for these genes are also provided.</p>
        <img src="pic/manualPics/multipleRice.PNG" alt="" style="width:500px">
        <p>Figure 7. Example of search by rice list.</p>
        <ul>
            <li>Basic rice information: click button to download information of the input rice.</li>
            <li>Rice distribution: histogram of the accession numbers of subspecies.</li>
            <li>Basic gene information: click button to download information of the shared genes.</li>
            <li>Gene statistics: The table summarizes the numbers of categorizations of shared genes. The three pie charts show the percentage of gene categorizations at different levels.</li>
        </ul>

        <h3>Search by gene ID list to obtain rice accessions where they all present</h3>
        <p>Users can type multiple gene IDs into the search box or upload a file containing gene IDs. Then, the basic information of rice accessions where these gene IDs all present and the input genes could be downloaded and the statistics tables and charts for these genes are also provided.</p>
        <img src="pic/manualPics/multipleGene.PNG" alt="" style="width:500px">
        <p>Figure 8. Example of Search by gene ID list.</p>
        <ul>
            <li>Basic rice information: click button to download information of the rice where all input genes present.</li>
            <li>Rice distribution: histogram of the accession numbers of subspecies.</li>
            <li>Basic gene information: click button to download information of the input genes. </li>
            <li>Gene statistics: The table summarizes the numbers of categorizations of the input genes. The three pie charts show the percentage of gene categorizations at different levels.</li> 
        </ul> -->
    </section>
	
	<section id="table">
		<h2>Table Browser</h2>
        <!-- <p>All information in the pan-genome browser was stored in tables that can be downloaded. These tables include the rice accession information table, the genome annotation table and gene expression profile table.</p> -->

		<h3>Sample Accession Table</h3>
		<!-- <p>In the rice accession information table, users can filter the results by selecting browse options such as sample type(normal/tumor), subtype. Attention: the result is the intersection of all the options. A summary table can be generated for filtered results.</p>
		<img src="pic/manualPics/riceTable1.PNG" alt="" style="width:800px">
        
	    <img src="pic/manualPics/riceTable2.PNG" alt="" style="width:800px"> -->
        <img src="pic/manualPics/sample_microbial1.png" alt="" style="width:800px">
        <p>Figure 1. Usage of sample accession table.</p>
        <!-- <p>For visualization, please ref <a href="#visualization">visualization</a> part.</p>
        <p>For summary, it is same with <a href="#multirice">search multiple rice accessions</a>.</p> -->

		
		<!-- <h3>Gene Table</h3>
		<p>In the gene information table, there are 50,995 full length genes. The basic gene information including chromosome positions on the reference IRGSP-1.0 genome, strand, CDS length and exon number, are contained in the table. Detailed gene information, such as gene categorization (core/distributed), gene presence frequency, gene ontology, coding sequence, and protein sequence, and visualization could be acquired by clicking the related links. The location of a genomic region can also be searched in a format of “chromosome ID: start coordinate-end coordinate”.</p>
		<img src="pic/manualPics/geneTable.PNG" alt="" style="width:800px">
        <p>Figure 10. Usage of gene table.</p>

        <h3>Expression Profile Table</h3>
        <p>A total of 226 runs of RNA-seq data from diverse rice tissues were collected. The detailed information of gene expression profiles could be acquired and visualized in the genome browser.</p>
        <img src="pic/manualPics/expression.PNG" alt="" style="width:600px">
        <p>Figure 11. Usage of expression profile table.</p> -->
	</section>
	
	<section id="visualization">
	  <!-- <h2>Visualization</h2>
	  <h3>Introduction</h3>
	  <p>The visualization page contains two parts, a dynamic tree browser on the left panel and a genome browser on the right panel. The tree was constructed from the SNP data. Users can select multiple nodes (including leaf nodes and internal nodes) and click the “Submit” button to visualize these rice accessions in the genome browser. The tree browser also supports search function to accelerate target genome selection. The pan-genome reference sequence, gene annotation and overall presence frequency of high quality accession are three basic tracks. There are 3,010 rice genome tracks and 226 RNA-seq tracks. Users can select any number of accessions or expression data through the hidden “Select tracks” panel or the tree browser as well. For the performance concern, we recommend to select less than 300 tracks each time. </p>
      <img src="pic/manualPics/visualization.PNG" alt="" style="width:800px">
      <p>Figure 12. Usage of browsers.</p>

	  <h3 id="tbrowser">Tree Browser</h3>
        <p>The tree browser is composed of a tree viewer and 4 toolbars, one of which lies at the bottom of the browser. The top toolbar is for locating the terminal nodes by accession codes. </p>
        <p>The next two toolbars change the behaviors of internal nodes and leaf nodes respectively. When "fold" is chosen, clicking internal nodes hides their child nodes. When "select" is chosen, clicking nodes select their child nodes (or themselves when clicking leaf nodes). A selected leaf node will be shown in genome browser when the "submit" button is clicked. When "preserve" is chosen, clicking nodes preserve their child nodes (or themselves when clicking leaf nodes). A preserved leaf node won't be hidden when folding its ancestors. Clicking a node for the second time behave oppositely in every chosen 'mode'. </p>
        <p>The last toolbar lies at bottom. It provides functions on selection. Clicking the "Next Selected" button scrolls the tree browser down to the location of the next selected leaf node. Clicking the "clear" button deselects all selected accessions. Clicking the "submit" buttons shows selected accessions in genome browser. Clicking the "Help" button shows description about the usage of each button. Clicking the "Hide All" button hides all internal nodes.</p>

      <h4>Genome Browser</h4>
        <p>The genome browser was based on JBrowse. The detailed usage of JBrowse could be acquired in the <a href="http://jbrowse.org/">JBrowse official site</a>.</p>

        <p>There are four buttons on the top of this panel.</p>
        <ul>
        <li>Remove all tracks: remove all shown tracks in the browser, except for 3 basic tracks (Reference sequence, gene, Presence Frequency).</li>
        <li>Screenshot: generates a screenshot for JBrowse in PDF format.</li>
        <li>Share: share the link of current genome browser.</li>
        <li>Help: View this manual.</li>
        </ul>

        <p>There are five types of tracks, including “reference sequence”, “gene”, “presence frequency”, accession and RNA-seq, and the first three types are default tracks.</p>
        <ul>
        <li>Reference sequence: the pan-genome sequence. Users could zoom in to see sequence at base level.</li>
        <li>Gene: the pan-genome gene annotation. Users could left-click genes to search in RPAN and right-click to view detailed information.</li>
        <li>Presence frequency: the presence frequency of high quality accession. There are five tracks, including the presence frequency of overall, JAP, IND, ARO and AUS.</li>
        <li>Accession: there are 3,010 accession tracks. Users could click the red lines to search in RPAN.</li>
        <li>RNA-seq: there 226 RNA-seq tracks. Users could click the blue plot to view detailed information about this run.</li>
        </ul> -->
	</section>

    <section id="download">
        <!-- <h2>Download</h2>
        <p>The reference pan-genome sequence and annotation are available on <a href="data_download.php">download</a> page.</p> -->
    </section>


</section>



<section id="update">
	<div class="page-header">
		<h1>Upadate logs</h1>
	</div>
	<ul>
        <li>2017.7.16 version 0.1 released</li>
        <ul>
        <li>construct sample-table microbial analysis function</li>
        <li>add sample table into database</li>
        <li>add user table into database</li>
        </ul>
        <!-- <li>2016.8.10 version 0.9 released</li>
        <ul>
        <li>reconstruct tree browser</li>
        <li>add toolbar to visualization page</li>
        <li>other minor improvements and bug fixes</li>
        </ul>
		<li>2016.5.5 version 0.8 released</li>
		<p>Database update</p>
		<li>2016.4.13 version 0.7 released</li>
		<p>Database update</p>
		<li>2016.4.1 version 0.6 released</li>
		<p>Database update</p>
		<li>2015.12.29 version 0.5 released</li>
		<p>Add expression data</p>
		<li>2015.12.19 version 0.4 released</li>
		<p>Add detailed information for genes</p>
		<li>2015.9.28 version 0.3 released</li>
		<p>Database update</p>
		<li>2015.8.13 version 0.2 released</li>
		<p>Database update</p>
		<li>2015.7.6 version 0.1 released</li> -->
	</ul>
</section>

</div>
</div>
</div>
<?php include 'include/footer.php' ?>

</body>
</html>
