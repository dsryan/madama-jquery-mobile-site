verbose(true)

task :default => :run

task :run => :deploy_to_apache do
  sh %{open '/Applications/Google Chrome.app' http://dhcp-10-111-55-50.kewr1.m.vonagenetworks.net/~dryan/madama/main2.html}
end

task :deploy_to_apache do
  puts 'starting deploy to apache...'
  # copy everything in public to ~/Sites/<some dir>
  TARGET = '/Users/dryan/Sites/madama'
  FileList[TARGET].each do |source|
    rm_rf source
  end
  # Dir.foreach(TARGET) { |file| rm file }

  FileList['public/**/*'].each do |source|
    cp_r source, TARGET, :verbose => true
  end  
end