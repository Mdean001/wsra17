<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<html><body>
<p>XML orriko galderak transformazioa aplikatuta</p>
	<table border="1">
		<thead><tr bgcolor="green"><th>Enuntziatua</th><th>Zailtasuna</th><th>Gaia</th><th>Erantzun zuzena</th><th>Erantzun okerrak</th></tr></thead>
			<xsl:for-each select="assessmentItems/assessmentItem" >
				<tr>
					<td>
					<font size="2" color="green" face="Verdana">
					<xsl:value-of select="itemBody/p"/> <br/>
					</font>
					</td>
					<td>
					<font size="2" color="green" face="Verdana">
					<xsl:value-of select="@complexity"/> <br/>
					</font>
					</td>
					<td>
					<font size="2" color="green" face="Verdana">
					<xsl:value-of select="@subject"/> <br/>
					</font>
					</td>
					<td>
					<font size="2" color="green" face="Verdana">
					<xsl:value-of select="correctResponse/value"/> <br/>
					</font>
					</td>
					<td>
					<font size="2" color="green" face="Verdana">
					<xsl:for-each select="incorrectResponses/value" >
						<xsl:value-of select="."/> <br/>
					</xsl:for-each>
					</font>
					</td>
				</tr>
			</xsl:for-each>
	</table>
</body></html>
</xsl:template>
</xsl:stylesheet>